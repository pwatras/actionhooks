<?php

namespace Dgm\Wp\Hook;
use Dgm\Wp\IHook;
class Action extends Base implements IHook {
    public function getType(): string {
        return IHook::HOOK_ACTION;
    }
    
    public function attach(callable $handler) {
        add_action($this->getHook(), $handler, $this->getPriority(), $this->getArgCount());
    }
}
