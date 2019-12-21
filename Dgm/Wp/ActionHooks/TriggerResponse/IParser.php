<?php
namespace Dgm\Wp\ActionHooks\TriggerResponse;
use Dgm\Wp\ActionHooks\ITriggerResponse;

use Dgm\Connectivity\IResponse;
interface IParser {
    public function canParse(IResponse $connectorResponse):bool;
    //public function parse(IResponse $connectorResponse):ITriggerResponse;
    public function parseActionResponse(IResponse $connectorResponse): IActionResponse;
    public function parseFilterResponse(IResponse $connectorResponse): IFilterResponse;
}
