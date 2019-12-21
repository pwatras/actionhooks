<?php
namespace Dgm\Connectivity\Request\Address;

abstract class Factory {
    public static function factory(string $address) {
        $proto = parse_url($address,PHP_URL_SCHEME);
        switch($proto) {
            case 'http':
            case 'https':
                return new Http($address);
            default:
                throw new \Exception('Unsupported request protocol');
        }
    }
}
