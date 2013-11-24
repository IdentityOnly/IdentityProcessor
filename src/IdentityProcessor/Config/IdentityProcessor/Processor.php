<?php
namespace IdentityProcessor\Config\IdentityProcessor;

use IdentityProcessor\Config\AbstractConfig;

class Processor extends AbstractConfig
{
    protected $name;

    protected $type;
    
    protected $emailAddresses;
    
    public function getName() {
        return $this->name;
    }
    
    public function setName($name) {
        $this->name = $name;
        return $this;
    }
    
    public function getType() {
        return $this->type;
    }
    
    public function setType($type) {
        $this->type = $type;
        return $this;
    }
    
    public function getEmailAddresses() {
        return $this->emailAddresses;
    }
    
    public function setEmailAddresses($emailAddresses) {
        $this->emailAddresses = $emailAddresses;
        return $this;
    }
    
    public function addEmailAddress($emailAddress) {
        $this->emailAddresses[] = $emailAddress;
        return $this;
    }
}
