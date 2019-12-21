<?php
namespace Dgm\Wp\Settings;

abstract class JsonFactory {
    const ARG_PATH = 'path';
    const ARG_JSON_STRING = 'string';
    
    public static function create(string $json,string $jsonArgType = self::ARG_PATH): \Dgm\Wp\ISettings {
        if($jsonArgType==self::ARG_PATH) {
            $data = json_decode(file_get_contents($json),true);
        } else {
            $data = json_decode($json,true);
        }
        return ArrayFactory::create($data);
    }
    
    
}
