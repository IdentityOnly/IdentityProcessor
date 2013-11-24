<?php
namespace IdentityProcessor\CQRS\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use IdentityProcessor\CQRS;

class ProcessReceivedEmails implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $messageService = $serviceLocator->get('IdentityCommon\Service\Message');
        $processorService = $serviceLocator->get('IdentityProcessor\Service\Processor');
    
        return new CQRS\ProcessReceivedEmails($messageService, $processorService);
    }
}
