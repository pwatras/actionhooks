<?php
namespace Dgm\Wp\ActionHooks\State;
use Dgm\Wp\Trigger\ITriggerCollection;


interface ITriggerProvider {
    public function getAll():ITriggerCollection;
}
