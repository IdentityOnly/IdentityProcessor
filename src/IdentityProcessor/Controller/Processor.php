<?php
namespace IdentityProcessor\Controller;

class Processor extends AbstractController
{
    public function processAction()
    {
        switch($this->params('job')) {
            case 'cron':
            default:
                $cron = $this->getServiceLocator()->get('IdentityProcessor\Service\Cron');
                return $cron->run();
            case 'received-emails':
                return $this->processReceivedEmailsAction();
        }
    }
    
    public function processReceivedEmailsAction()
    {
        $messageService = $this->getServiceLocator()->get('IdentityCommon\Service\Message');
        $processReceivedEmails = $this->getServiceLocator()->get('IdentityProcessor\CQRS\ProcessReceivedEmails');
        
        $messages = $messageService->findUnprocessedReceivedMessages();
        $processReceivedEmails->setMessages($messages);
        $processReceivedEmails->setPersistChanges(!$this->params('dry-run'));
        
        $processedMessages = $processReceivedEmails->execute();
        if($this->params('verbose')) {
            foreach($processedMessages as $message) {
                echo "[{$message->getId()}] {$message->getType()}".PHP_EOL;
                echo "\tLink: {$message->getLink()}".PHP_EOL;
            }
        }
    }
}
