<?php
namespace Dgm\Wp;
interface IHook {
    const HOOK_ACTION = 'action';
    const HOOK_FILTER = 'filter';
    const DEFAULT_PRIORITY = 10; //by default use the wp default
    const DEFAULT_ARG_COUNT = 1; //by default use the wp default
    
    public function getType():string;
    public function getPriority():int;
    public function getArgCount():int;
    public function getHook():string; 
    
    public function attach(callable $handler);
    
}
