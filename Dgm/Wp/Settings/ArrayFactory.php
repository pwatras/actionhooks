<?php


namespace Dgm\Wp\Settings;

abstract class ArrayFactory {
    public static function create(array $settings) {
        $branches = [];
        foreach($settings as $key=>$value) {
            if(is_array($value)) {
                $branches[$key] = self::create($value);
            }
        }
        return new \Dgm\Wp\Settings($settings, $branches);
    }
}
