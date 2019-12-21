<?php
namespace Dgm\Wp\Trigger;
use Dgm\Wp\IHook;
use Dgm\Wp\IConnector;
use Dgm\Wp\IRequestDispatcher;
use Dgm\Wp\ITrigger;
use Dgm\IOpts;

abstract class Factory {
    public static function create(IHook $hook, IConnector $connector, IRequestDispatcher $dispatcher,?IOpts $options = null): ITrigger {
        if($hook->getType()== IHook::HOOK_FILTER && $connector->getType()== IConnector::ASYNC) {
            throw new \Exception('Filter hooks cannot use async connections');
        }
        switch($hook->getType()) {
            case IHook::HOOK_ACTION:
                $trigger = new Action($hook,$connector,$dispatcher,$options);
                break;
            case IHook::HOOK_FILTER:
                $trigger =  new Filter($hook,$connector,$dispatcher,$options);
                break;
            default:
                throw new \Exception(__METHOD__.': unexpected IHook type');
        }
        $trigger->decorateInput(new Decorator\PostArg());
        return $trigger;
    }
}
