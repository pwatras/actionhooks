<?php
namespace Dgm\Wp\ActionHooks\TriggerResponse\Parser;
use Dgm\Connectivity\IResponse;
use Dgm\Wp\ActionHooks\TriggerResponse\IActionResponse;
use Dgm\Wp\ActionHooks\TriggerResponse\IFilterResponse;
use Dgm\Wp\ActionHooks\ITriggerResponse;
use Dgm\Wp\ActionHooks\TriggerResponse;
use Dgm\Wp\ActionHooks\TriggerResponse\IParser;
/*
 * Parser for full ActionHooks Responses
 */
class AHResponse implements IParser {
    public function canParse(IResponse $connectorResponse): bool {
        return ($connectorResponse->getMetaField('X-ActionHooksResponse')=='true');
    }
    
    /*public function parse(IResponse $connectorResponse): ITriggerResponse {
        if($this->isJson($connectorResponse)) {
            $data = json_decode($connectorResponse->getContentString());
        }
        //todo: maybe other deserialization formats?
        return new TriggerResponse($data['response'], array_key_exists('triggers', $data)?$data['triggers']:[]);
    }*/
    
    public function parseActionResponse(IResponse $connectorResponse): IActionResponse {
        if($this->isJson($connectorResponse)) {
            $data = json_decode($connectorResponse->getContentString());
        }
        //todo: maybe other deserialization formats?
        return new TriggerResponse\ActionResponse($data['response'], array_key_exists('triggers', $data)?$data['triggers']:[]);
    }
    public function parseFilterResponse(IResponse $connectorResponse): IFilterResponse {
        if($this->isJson($connectorResponse)) {
            $data = json_decode($connectorResponse->getContentString());
        }
        //todo: maybe other deserialization formats?
        return new TriggerResponse\FilterResponse($data['response'], array_key_exists('triggers', $data)?$data['triggers']:[]);
    }
    
    protected function isJson(IResponse $response):bool {
        return ($response->getContentType()->getType()=='application/json');
    }
}
