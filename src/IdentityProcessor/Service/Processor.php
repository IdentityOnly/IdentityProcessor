<?php
namespace IdentityProcessor\Service;

use IdentityCommon\Service\AbstractService;

use Zend\Mail\Message;

class Processor extends AbstractService
{
    public function findForMailMessage(Message $message) {
        $config = $this->getServiceLocator()->get('IdentityProcessor\Config\IdentityProcessor');
        
        $emailAddress = $message->getHeaders()->get('From');
        
        if($emailAddress) {
            foreach($config->getProcessors() as $processor) {
                foreach($processor->getEmailAddresses() as $processorEmailAddress) {
                    if($emailAddress->getAddressList()->has($processorEmailAddress)) {
                        return $this->getServiceLocator()->get($processor->getType());
                    }
                }
            }
        }
    }
}
