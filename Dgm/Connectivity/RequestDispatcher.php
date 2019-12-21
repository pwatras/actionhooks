<?php
namespace Dgm\Connectivity;

class RequestDispatcher implements IRequestDispatcher {
    private $triggers = [];
    private $async = [];
    
    
    public function handle(IConnector $connector, IRequest $request):bool {
        switch($connector->getType()) {
            case IConnector::SYNC:
                return $this->handleSync($connector,$request);
            case IConnector::ASYNC:
                return $this->handleAsync($connector,$request);
            default: 
                throw new \Exception('Unexpected type of IConnector');
        }
    }
    
    public function await() {
        $this->awaitAsync();
    }
    
    
    public function handleSync(IConnector $connector, IRequest $request):bool {
        if($connector->getType()!= IConnector::SYNC) {
            throw \Exception(__METHOD__.' handles only sync connectors');
        }
        $connector->call($request);
        $connector->await();
        return !$connector->isError();
    }
    
    public function handleAsync(IConnector $connector, IRequest $request) {
        if($connector->getType()!= IConnector::ASYNC) {
            throw \Exception(__METHOD__.' handles only async(asynchronous) connectors');
        }
        $connector->call($request);
        array_push($this->async,$connector);
        return true;
    }
    
    
    private function awaitAsync() {
        array_walk($this->async,function(IConnector $connector) {
            $connector->await();
        });
    }
    
    
    
}
