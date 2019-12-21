<?php
namespace Dgm\Connectivity\Connector;
use Dgm\IOpts;
abstract class Factory {
    private const DEFAULT_CONNECTOR = HttpPost::class;
    
    private static $connectors = [];
    
    public static function create(?string $typeHandle = null) {
        if(!is_null($typeHandle) && array_key_exists($typeHandle, self::$connectors)) {
            $handleClass = self::$connectors[$typeHandle];
        } else {
            $handleClass = self::DEFAULT_CONNECTOR;
        }
        return new $handleClass();
    }
    
    public static function registerConnector(string $connectorClass,?string $handle = null) {
        if(is_null($handle)) {
            $handle = $connectorClass;
        }
        self::$connectors[$handle] = $connectorClass;
    }
    
    
}
