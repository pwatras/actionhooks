<?php
namespace Dgm\Wp\Hook;
use Dgm\Wp\IHook;
abstract class Base implements IHook {
    private $argCount;
    private $priority;
    private $hook;
    function __construct(string $hookHandle, int $argCount = IHook::DEFAULT_ARG_COUNT,int $priority = IHook::DEFAULT_PRIORITY) {
        $this->hook = $hookHandle;
        $this->priority = $priority;
        $this->argCount = $argCount;
    }
    
    public function getArgCount(): int {
        return $this->argCount;
    }
    
    public function getPriority(): int {
        return $this->priority;
    }
    
    public function getHook(): string {
        return $this->hook;
    }
}
