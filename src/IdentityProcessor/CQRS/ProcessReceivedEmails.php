<?php
namespace IdentityProcessor\CQRS;

use IdentityCommon\Entity;
use IdentityCommon\Service as CommonService;
use IdentityCommon\CQRS\AbstractCQRS;

use IdentityProcessor\Service as ProcessorService;

use Doctrine\Common\Collections\ArrayCollection;

class ProcessReceivedEmails extends AbstractCQRS
{
    protected $messageService;
    
    protected $processorService;

    protected $messages;
    
    protected $persistChanges = false;
    
    public function __construct(CommonService\Message $messageService, ProcessorService\Processor $processorService) {
        $this->setMessageService($messageService);
        $this->setProcessorService($processorService);
        
        $this->setMessages(new ArrayCollection);
    }

    public function execute() {
        $messageService = $this->getMessageService();
        $processorService = $this->getProcessorService();
        
        $processedMessages = new ArrayCollection;
        
        $messages = $this->getMessages();
        foreach($messages as $message) {
            $message->setProcessed(true);
        
            $processor = $processorService->findForMailMessage($message->getMessage());
            if(!$processor) {
                $message->setErrorCode($message::ERROR_PROCESSOR_NOT_FOUND);
                continue;
            }
            
            $processedMessage = $processor->process($message);
            if(!($processedMessage instanceof Entity\ProcessedMessage)) {
                if(is_int($processedMessage)) {
                    $message->setErrorCode($processedMessage);
                } else {
                    $message->setErrorCode($message::ERROR_FAILED_PROCESSING);
                }
                continue;
            }
            
            $processedMessages[] = $processedMessage;
        }
        
        if($this->getPersistChanges()) {
            $messageService->saveReceivedMessages($messages);
            $messageService->saveProcessedMessages($processedMessages);
        }
        
        return $processedMessages;
    }
    
    public function getMessageService() {
        return $this->messageService;
    }
    
    public function setMessageService($messageService) {
        $this->messageService = $messageService;
        return $this;
    }
    
    public function getProcessorService() {
        return $this->processorService;
    }
    
    public function setProcessorService($processorService) {
        $this->processorService = $processorService;
        return $this;
    }
    
    public function getMessages() {
        return $this->messages;
    }
    
    public function setMessages($messages) {
        $this->messages = $messages;
        return $this;
    }
    
    public function getPersistChanges() {
        return $this->persistChanges;
    }
    
    public function setPersistChanges($persistChanges) {
        $this->persistChanges = $persistChanges;
        return $this;
    }
}
