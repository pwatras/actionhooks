<?php


namespace Dgm\Wp\ActionHooks\TriggerResponse\Parser;
use Dgm\Wp\ActionHooks\TriggerResponse\IParser;
use Dgm\Connectivity\IResponse;
use Dgm\Wp\ActionHooks\ITriggerResponse;
class Composite implements IParser, IDispatcher {
    private $filterParsers = [];
    private $actionParsers = [];
    
    
    
    function __construct() {
    }
    
    /*public function addParser(IParser $parser) {
        array_push($this->parsers,$parser);
    }*/
    public function addParser(IParser $parser, string $enumType) {
        if($enumType==IDispatcher::TYPE_ACTION || $enumType== IDispatcher::TYPE_ACTION_FILTER) {
            array_push($this->actionParsers,$parser);
        }
        if($enumType==IDispatcher::TYPE_FILTER || $enumType== IDispatcher::TYPE_ACTION_FILTER) {
            array_push($this->filterParsers,$parser);
        }
        
    }

    public function canParse(IResponse $connectorResponse): bool {
        throw new \Exception('not implemented');
        //return !is_null($this->getParser($connectorResponse));
    }
    
    public function parseActionResponse(IResponse $connectorResponse): \Dgm\Wp\ActionHooks\TriggerResponse\IActionResponse {
        $parser = $this->getParser($connectorResponse,$this->actionParsers);
        if(is_null($parser)) { throw new \Exception('No parser available'); }
        return $parser->parseActionResponse($connectorResponse);
    }
    
    public function parseFilterResponse(IResponse $connectorResponse): \Dgm\Wp\ActionHooks\TriggerResponse\IFilterResponse {
        $parser = $this->getParser($connectorResponse,$this->filterParsers);
        if(is_null($parser)) { throw new \Exception('No parser available'); }
        return $parser->parseFilterResponse($connectorResponse);
    }


    /*public function parse(IResponse $connectorResponse): ITriggerResponse {
        $parser = $this->getParser($connectorResponse);
        if(is_null($parser)) { throw new \Exception('No parser available'); }
        return $parser->parse($connectorResponse);
    }*/

    private function getParser(IResponse $connectorResponse,array $parsers):?IParser {
        foreach($parsers as $parser) {
            if($parser->canParse($connectorResponse)) { return $parser; }
        }
        return null;
    }
    
}
