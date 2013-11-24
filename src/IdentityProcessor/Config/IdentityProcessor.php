<?php
namespace IdentityProcessor\Config;

use IdentityProcessor\Config\IdentityProcessor\Processor;

class IdentityProcessor extends AbstractConfig
{
    protected $cron = array();
    
    protected $processors = array();
    
    public function getCron() {
        return $this->cron;
    }
    
    public function setCron($cron) {
        $this->cron = $cron;
        return $this;
    }
    
    public function getProcessors() {
        return $this->processors;
    }
    
    public function setProcessors($processors) {
        foreach($processors as $key => $processor) {
            if(is_array($processor)) {
                $processors[$key] = new Processor($processor);
            }
        }
        $this->processors = $processors;
        return $this;
    }
    
    public function addProcessors($processors) {
        if(is_array($processor)) {
            $processor = new Processor($processor);
        }
        $this->processors[] = $processors;
        return $this;
    }
}
