<?php


namespace Dgm\Connectivity\Request\Address;
use Dgm\Connectivity\Request\IAddress;
class Http implements IAddress {
    private $address;
    function __construct(string $address) {
        $this->address = $address;
    }
    
    public function toString(): string {
        return $this->address;
    }
}
