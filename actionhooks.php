<?php
/*
Plugin Name: Action Hooks
Plugin URI: http://actionhooks.com/
Description: Convert wp actions into REST webhook calls
Author: Piotr Watras @ dgmonitor
Version: 1.0.0
Author URI: http://dgmonitor.pl/
*/
require __DIR__.'/vendor/autoload.php';
if(!defined('MODE_DEV')) { define('MODE_DEV',true); }
spl_autoload_register(function(string $clsName){
    if(substr($clsName,0,4)!='Dgm\\') { return false; }
    $path = __DIR__.DIRECTORY_SEPARATOR.str_replace('\\',DIRECTORY_SEPARATOR,$clsName).'.php';
    if(!file_exists($path)) { return false; }
    require_once $path;
    return true;
});
//validate environment
$validator = new \Dgm\EnvValidator();
$validator->registerValidator(new \Dgm\Wp\ActionHooks\EnvValidators\CurlExtension());
$validator->automatic();


if(defined('MODE_DEV') && file_exists(__DIR__.'/dev.php')) {
    require __DIR__.'/dev.php';
}