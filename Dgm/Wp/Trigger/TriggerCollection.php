<?php
namespace Dgm\Wp\Trigger;
use \Dgm\Wp\ITrigger;

class TriggerCollection implements ITriggerCollection {
    private $triggers = [];
    function __construct(ITrigger ...$triggers) {
        $this->triggers = $triggers;
    }
    
    public function attachAll() {
        array_walk($this->triggers,function(ITrigger $trigger) {
            $trigger->attach();
        });
    }
}
