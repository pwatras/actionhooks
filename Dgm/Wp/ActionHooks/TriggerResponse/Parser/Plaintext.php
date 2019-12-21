<?php

namespace Dgm\Wp\ActionHooks\TriggerResponse\Parser;
use Dgm\Connectivity\IResponse;

use Dgm\Wp\ActionHooks\TriggerResponse\IActionResponse;
use Dgm\Wp\ActionHooks\TriggerResponse\IFilterResponse;
use Dgm\Wp\ActionHooks\TriggerResponse;
use Dgm\Wp\ActionHooks\TriggerResponse\IParser;

class Plaintext implements IParser {
    public function canParse(IResponse $connectorResponse): bool {
        return true;
    }
    
    public function parse(IResponse $connectorResponse): ITriggerResponse {
        
        return new TriggerResponse(
                
        );
    }
    
    public function parseFilterResponse(IResponse $connectorResponse): \Dgm\Wp\ActionHooks\TriggerResponse\IFilterResponse {
        /* plaintext response cannot have any triggers - explicitly expose
         * this fact in args for constructor - second arg is empty array
         */
        return new TriggerResponse\FilterResponse(
                $connectorResponse->getContentString(),
                []
        );
    }


    public function parseActionResponse(IResponse $connectorResponse): \Dgm\Wp\ActionHooks\TriggerResponse\IActionResponse {
        /* plaintext response cannot have any triggers - explicitly expose
         * this fact in args for constructor - second arg is empty array
         */
        return new TriggerResponse\ActionResponse(
                $connectorResponse->getContentString(),
                []
        );
    }
}
