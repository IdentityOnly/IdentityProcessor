<?php
namespace IdentityProcessor\Config\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use IdentityProcessor\Config;

class IdentityProcessor implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Config');
        return new Config\IdentityProcessor($config['identity_processor']);
    }
}
