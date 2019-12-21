<?php
namespace Dgm\Wp\ActionHooks\State\TriggerProvider;
use Dgm\Wp\ActionHooks\State\ITriggerProvider;
use Dgm\Wp\Trigger\ITriggerCollection;
class Composite implements ITriggerProvider {
    private $providers = [];
    
    public function addProvider(ITriggerProvider $provider) {
        array_push($this->providers,$provider);
    }
    
    public function getAll(): ITriggerCollection {
        $all = [];
        foreach($this->providers as $provider) {
            $all = array_merge($all,$provider->getAll());
        }
        return $all;
    }
}
