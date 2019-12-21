<?php

namespace Dgm\Wp\ActionHooks\TriggerRequest;
use Dgm\Wp\ActionHooks\TriggerRequest;
use Dgm\Wp\ActionHooks\ITriggerRequest;
use Dgm\Connectivity\IConnector;

class Action extends TriggerRequest implements ITriggerRequest {
    function __construct(array $args, \Dgm\Connectivity\Request\IAddress $endpoint, bool $needsResponse = false) {
        parent::__construct(
                $args,
                $endpoint,
                $needsResponse, 
                $needsResponse?IConnector::SYNC:IConnector::ASYNC //response neeeded? must be sync. if not, use async for better performance
        );
    }
}
