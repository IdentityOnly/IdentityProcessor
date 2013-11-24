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
        
    }
}
