<?php
namespace Dgm\Wp\Hook;
use Dgm\Wp\IHook;

abstract class Factory {
    public static function create(
            string $hookType,
            string $hookHandle,
            int $argCount = IHook::DEFAULT_ARG_COUNT,
            int $priority = IHook::DEFAULT_PRIORITY
    ):IHook {
        
        switch($hookType) {
            case IHook::HOOK_ACTION:
                $hook = new Action($hookHandle, $argCount, $priority);
                break;
            case IHook::HOOK_FILTER:
                $hook = new Filter($hookHandle, $argCount, $priority);
                break;
            default:
                throw new \Exception('Unrecognized hook type: '.$hookType);
        }
        return $hook;
        
    }
}
