<?php
namespace IdentityProcessor\Processor;

use IdentityCommon\Entity\ReceivedMessage;
use IdentityCommon\Entity\ProcessedMessage;

use Zend\Mail;
use Zend\Mime;

class GitHub extends AbstractProcessor
{
    const REGISTRATION_MESSAGE = 'Welcome to GitHub';
    const RESET_MESSAGE = 'reset your password';
    const DELETION_MESSAGE = 'Account deletion';
    
    const RESET_REGEX = '/Use the following link within the next 24 hours to reset your password:\n\n(.*)\n\n/iU';

    public function process(ReceivedMessage $message) {
        $processed = $this->getProcessedMessage();
        $mailMessage = $message->getMessage();
        
        if(!($messageType = $this->detectMessageType($mailMessage))) {
            return false;
        }
        $processed->setType($messageType);
        
        $body = $mailMessage->getBody();
        if($body instanceof Mime\Message) {
            foreach($body->getParts() as $part) {
                switch($part->getType()) {
                    case Mime\Mime::TYPE_TEXT:
                        if($this->processTextMessage($processed, $messageType, $part->getContent())) {
                            break 2;
                        } else {
                            break;
                        }
                    case Mime\Mime::TYPE_HTML:
                        if($this->processHtmlMessage($processed, $messageType, $part->getContent())) {
                            break 2;
                        } else {
                            break;
                        }
                }
            }
            return false;
        } elseif(is_string($body)) {
            if(!$this->processTextMessage($processed, $body)) {
                return false;
            }
        }
        
        return $processed;
    }
    
    protected function detectMessageType($mailMessage) {
        if($body instanceof Mime\Message) {
            foreach($body->getParts() as $part) {
                if(stripos($part->getContent(), self::REGISTRATION_MESSAGE) !== false) {
                    return ProcessedMessage::TYPE_REGISTRATION;
                }
            }
        } elseif(is_string($body) && (stripos($body, self::REGISTRATION_MESSAGE) !== false)) {
            return ProcessedMessage::TYPE_REGISTRATION;
        }
        
        if(stripos($mailMessage->getHeaders()->get('Subject'), self::RESET_MESSAGE) !== false) {
            return ProcessedMessage::TYPE_RESET;
        }
        
        if(stripos($mailMessage->getHeaders()->get('Subject'), self::DELETION_MESSAGE) !== false) {
            return ProcessedMessage:TYPE_DELETION;
        }
    }
    
    protected function processTextMessage(&$processed, $messageType, $body) {
        switch($messageType) {
            case ProcessedMessage::TYPE_REGISTRATION:
                return true;
            case ProcessedMessage::TYPE_RESET:
                if(preg_match(self::RESET_REGEX, $body, $matches)) {
                    list(,$url) = $matches;
                    $processed->setLink($url);
                    return true;
                }
                break;
            case ProcessedMessage::TYPE_DELETION:
                return true;
        }
        
        return false;
    }
    
    /**
     * Presently unimplemented.
     */
    protected function processHtmlMessage(&$processed, $messageType, $body) {
        switch($messageType) {
            case ProcessedMessage::TYPE_REGISTRATION:
                return true;
            case ProcessedMessage::TYPE_RESET:
                return false;
            case ProcessedMessage::TYPE_DELETION:
                return true;
        }
        
        return false;
    }
}
