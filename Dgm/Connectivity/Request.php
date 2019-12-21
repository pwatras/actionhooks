<?php

namespace Dgm\Connectivity;
use Dgm\Connectivity\Request\IAddress;
class Request implements IRequest {
    private $body;
    private $address;
    function __construct(IAddress $adr,string $body = '') {
        $this->address = $adr;
        $this->body = $body;
    }
    
    public function getAddress(): IAddress {
        return $this->address;
    }
    
    public function getContent(): string {
        return $this->body;
    }
}
