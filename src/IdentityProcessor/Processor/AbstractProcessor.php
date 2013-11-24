<?php
namespace IdentityProcessor\Processor;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

use IdentityCommon\Entity\ReceivedMessage;
use IdentityCommon\Entity\ProcessedMessage;

abstract class AbstractProcessor implements ServiceLocatorAwareInterface
{
    use ServiceLocatorAwareTrait;
    
    protected $processedMessage;
    
    /**
     * Process a message
     *
     * @param ReceivedMessage $message
     * @return ProcessedMessage
     */
    public function process(ReceivedMessage $message);
    
    public function getProcessedMessage() {
        if(!$this->processedMessage) {
            $this->processedMessage = new ProcessedMessage;
        }
        return $this->processedMessage;
    }
    
    public function setProcessedMessage($processedMessage) {
        $this->processedMessage = $processedMessage;
        return $this;
    }
}
