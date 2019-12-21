<?php


namespace Dgm\Wp\ActionHooks\TriggerRequest;
use Dgm\Wp\ActionHooks\ITriggerRequest;

use Dgm\Connectivity\IRequestDispatcher;
use Dgm\Connectivity\IConnector;
use Dgm\Wp\ActionHooks\TriggerResponse;
use Dgm\Wp\ActionHooks\TriggerRequest;


class Dispatcher implements IDispatcher {
    private $requestDispatcher;
    private $parser;
    //private $connectorStack = [];
    
    function __construct(IRequestDispatcher $reqDispatcher, TriggerResponse\Parser\IDispatcher $parser) {
        $this->requestDispatcher = $reqDispatcher;
        $this->parser = $parser;
        
    }
    
    public function handle(\Dgm\Wp\ActionHooks\ITriggerRequest $request) {
        $connector = $this->getConnectorObject($request);
        $this->requestDispatcher->handle(
                $connector, 
                $request
        );
        if($request->needsResponse()) {
            $connector->await();
            
            if($connector->isError()) { 
                //todo:  handle/log/report errors
                return null;
            }
            if($request instanceof TriggerRequest\Action) {
                return $this->processActionResponse($connector->getResponse());
            } elseif($request instanceof TriggerRequest\Filter) {
                return $this->processFilterResponse($connector->getResponse());
            }
        } /*else {
            array_push($this->connectorStack,$connector);
        }*/
        return null;
        /* todo: decide how to handle responses from async-triggers.
         * we dont need the content (if we need it it will be sync-requested),
         * but maybe the (full-format) responses could contain requests
         * to call hooks etc. (or other functionality that will be added later)
         * and we could handle them before terminating the main wp process
         */
    }
    
    /*public function getAsyncResponses() {
        $this->requestDispatcher->await();
        $ret = [];
        array_walk($this->connectorStack,function(IConnector $connector) {
            
        });
    }*/

    protected function getConnectorObject(ITriggerRequest $tr): IConnector {
        if($tr->getAddress() instanceof \Dgm\Connectivity\Request\Address\Http) {
            return \Dgm\Connectivity\Connector\HttpPost::factory($tr->getType());
        }
    }
    
    protected function processActionResponse(\Dgm\Connectivity\IResponse $connectorResponse):?string {
        $response = $this->parser->parseActionResponse($connectorResponse);
        //todo: $response->getTriggers()
        return $response->hasContent()?$response->getContent():null;
    }
    
    protected function processFilterResponse(\Dgm\Connectivity\IResponse $connectorResponse):?string {
        $response = $this->parser->parseFilterResponse($connectorResponse);
        return $response->getData();
    }
}
