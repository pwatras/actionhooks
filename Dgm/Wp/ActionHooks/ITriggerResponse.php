<?php
namespace Dgm\Wp\ActionHooks;

interface ITriggerResponse {
    
    public function hasTriggers():bool;
    public function getTriggers():array;
}
