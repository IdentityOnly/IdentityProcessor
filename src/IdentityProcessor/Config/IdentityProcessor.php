<?php
namespace IdentityProcessor\Config;

class IdentityProcessor extends AbstractConfig
{
    protected $cron = array();
    
    public function getCron() {
        return $this->cron;
    }
    
    public function setCron($cron) {
        $this->cron = $cron;
        return $this;
    }
}
