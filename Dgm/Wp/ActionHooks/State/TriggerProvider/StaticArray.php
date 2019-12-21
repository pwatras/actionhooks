<?php
namespace Dgm\Wp\ActionHooks\State\TriggerProvider;
use Dgm\Wp\ActionHooks\State\ITriggerProvider;
use Dgm\Wp\Trigger\ITriggerCollection;
use Dgm\Wp\Trigger\TriggerCollection;
use \Dgm\Wp\Trigger;

//for testing: getAll() returns a hand-coded fixed TriggerCollection 
class StaticArray implements ITriggerProvider {
    public function getAll(): ITriggerCollection {
        $triggers = [];
        //$triggers[] = new Trigger\Action($hook, $connector, $dispatcher);
        return new TriggerCollection(...$triggers);
    }
}
