<?php
namespace IdentityProcessor\Config;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Stdlib\Hydrator\Filter;

abstract class AbstractConfig implements ServiceLocatorAwareInterface
{
    use ServiceLocatorAwareTrait;
    
    protected $hydrator;
    
    public function __construct($data = null) {
        if(isset($data)) {
            $hydrator = $this->getHydrator();
            $hydrator->hydrate($data, $this);
        }
    }
    
    public function getHydrator() {
        if(!$this->hydrator) {
            $hydrator = new ClassMethods;
            $hydrator->addFilter('getHydrator', new Filter\MethodMatchFilter('getHydrator'), Filter\FilterComposite::CONDITION_AND);
            
            $this->hydrator = $hydrator;
        }
        return $this->hydrator;
    }
    
    public function setHydrator($hydrator) {
        $this->hydrator = $hydrator;
        return $this;
    }
    
}
