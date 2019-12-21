<?php



namespace Dgm\Wp\ActionHooks\TriggerResponse;
use Dgm\Wp\ActionHooks\ITriggerResponse;
interface IActionResponse extends ITriggerResponse {
    public function hasContent():bool;
    public function getContent():string;
}
