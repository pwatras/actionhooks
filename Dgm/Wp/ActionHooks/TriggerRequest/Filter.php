<?php

namespace Dgm\Wp\ActionHooks\TriggerRequest;
use Dgm\Wp\ActionHooks\TriggerRequest;
use Dgm\Wp\ActionHooks\ITriggerRequest;
use Dgm\Connectivity\IConnector;
class Filter extends TriggerRequest implements ITriggerRequest {
    function __construct(array $args, \Dgm\Connectivity\Request\IAddress $endpoint) {
        //filter request always needs immediate response:
        //need response: true
        //connection type: sync
        parent::__construct($args, $endpoint, true,IConnector::SYNC);
    }
}
