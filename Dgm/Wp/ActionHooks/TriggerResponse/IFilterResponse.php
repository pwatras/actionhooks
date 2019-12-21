<?php
namespace Dgm\Wp\ActionHooks\TriggerResponse;
use Dgm\Wp\ActionHooks\ITriggerResponse;
interface IFilterResponse extends ITriggerResponse {
    public function getData();
}
