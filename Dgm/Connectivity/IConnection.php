<?php
namespace Dgm\Connectivity;
use Dgm\Connectivity\IConnector;
use Dgm\Connectivity\Request\IAddress;

interface IConnection {
    public function getConnector():IConnector;
    public function getAddress():IAddress;
    public function getConnectionType():string;
}
