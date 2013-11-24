<?php
namespace IdentityProcessor\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use IdentityProcessor\Service;

class Cron implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('IdentityProcessor\Config\IdentityProcessor');
    
        $cron = new Service\Cron;
        foreach($config->getCron() as $name => $job) {
            $cron->add($name, $job);
        }
        
        return $cron;
    }
}
