<?php
namespace Dgm\Wp\ActionHooks;
use Dgm\Connectivity\IRequest;
interface ITriggerRequest extends IRequest {
    public function getArgs():array;
    public function needsResponse():bool;
    public function getType():string;
}
