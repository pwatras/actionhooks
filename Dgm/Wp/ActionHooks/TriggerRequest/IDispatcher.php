<?php

namespace Dgm\Wp\ActionHooks\TriggerRequest;
use Dgm\Wp\ActionHooks\ITriggerRequest;
use Dgm\Wp\ActionHooks\ITriggerResponse;
interface IDispatcher {
    public function handle(ITriggerRequest $request);
}
