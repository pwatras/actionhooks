<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Dgm\Wp\ActionHooks\TriggerResponse\Parser;
use Dgm\Wp\ActionHooks\TriggerResponse\IParser;
use Dgm\Connectivity\IResponse;
use Dgm\Wp\ActionHooks\TriggerResponse;
class DataResponse implements IParser {
    public function canParse(IResponse $connectorResponse): bool {
        return $this->canDeserialize($connectorResponse);
    }
    /*public function parse(IResponse $connectorResponse): \Dgm\Wp\ActionHooks\ITriggerResponse {
        if($this->isJson($connectorResponse)) {
            $data = json_decode($connectorResponse->getContentString());
        }
        return new TriggerResponse($data,[]);
    }*/
    
    public function parseActionResponse(IResponse $connectorResponse): \Dgm\Wp\ActionHooks\TriggerResponse\IActionResponse {
        //action response must be a single string to echo - not data
        throw new \Exception('Data responses are not allowed for actions');
        if($this->isJson($connectorResponse)) {
            $data = json_decode($connectorResponse->getContentString());
        }
        return new TriggerResponse\ActionResponse($data,[]);
    }
    
    public function parseFilterResponse(IResponse $connectorResponse): \Dgm\Wp\ActionHooks\TriggerResponse\IFilterResponse {
        
        if($this->isJson($connectorResponse)) {
            $data = json_decode($connectorResponse->getContentString());
        }
        return new TriggerResponse\FilterResponse($data,[]);
    }

    
    protected function isJson(IResponse $response):bool {
        return ($response->getContentType()->getType()=='application/json');
    }
    
    protected function canDeserialize(IResponse $response):bool {
        return $this->isJson($response);
    }
}
