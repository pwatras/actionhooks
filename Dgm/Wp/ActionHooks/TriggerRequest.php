<?php
namespace Dgm\Wp\ActionHooks;
use Dgm\Connectivity\Request\IAddress;
use Dgm\Connectivity\IConnector;
abstract class TriggerRequest implements ITriggerRequest {
    private $args;
    private $endpoint;
    private $type;
    private $needsResponse;
    function __construct(array $args, IAddress $endpoint,bool $needsResponse = false,string $type = IConnector::ASYNC) {
        $this->args = $args;
        $this->endpoint = $endpoint;
        $this->type = $type;
        $this->needsResponse = $needsResponse;
    }
    //IRequest:
    public function getAddress(): IAddress {
        return $this->endpoint;
    }
    
    public function getContent(): string {
        return json_encode($this->getArgs());
    }
    
    //ITriggerRequest
    public function getArgs(): array {
        return $this->args;
    }
    
    
    public function getType(): string {
        return $this->type;
    }
    
    public function needsResponse(): bool {
        return $this->needsResponse;
    }
}
