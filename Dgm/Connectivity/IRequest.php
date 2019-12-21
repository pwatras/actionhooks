<?php

namespace Dgm\Connectivity;

interface IRequest {
    public function getContent():string;
    public function getAddress(): Request\IAddress;
}
