<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Dgm\Connectivity;
use Dgm\Connectivity\IConnector;
use Dgm\Connectivity\Request\IAddress;
class Connection implements IConnection {
    private $address;
    private $connector;
    
    function __construct(IAddress $address, IConnector $connector) {
        $this->address = $address;
        $this->connector = $connector;
    }
    
    public function getAddress(): IAddress { return $this->address; }
    public function getConnector(): IConnector { return $this->connector; }
    public function getConnectionType(): string {
        return $this->connector->getType();
    }
}
