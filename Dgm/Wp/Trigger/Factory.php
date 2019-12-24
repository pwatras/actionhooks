<?php
namespace Dgm\Wp\Trigger;
use Dgm\Wp\IHook;
use Dgm\Wp\ActionHooks\TriggerRequest\IDispatcher;
use Dgm\Wp\ITrigger;
use Dgm\IOpts;
use Dgm\Connectivity\Request\IAddress;

abstract class Factory {
    private static $inputDecorators = [];
    
    public static function create(IHook $hook, IAddress $address,IDispatcher $dispatcher,?IOpts $opts = null): ITrigger {
        switch($hook->getType()) {
            case IHook::HOOK_ACTION:
                $trigger = new Action($hook,$address,$dispatcher,$opts);
                break;
            case IHook::HOOK_FILTER:
                $trigger =  new Filter($hook,$address,$dispatcher,$opts);
                break;
            default:
                throw new \Exception(__METHOD__.': unexpected IHook type');
        }
        array_walk(self::$inputDecorators,function(Decorator\IInputDecorator $decorator) use($trigger) {
            $trigger->decorateInput($decorator);
        });
        return $trigger;
    }
    
    public static function addInputDecorator(Decorator\IInputDecorator $decorator) {
        array_push(self::$inputDecorators,$decorator);
    }
}
