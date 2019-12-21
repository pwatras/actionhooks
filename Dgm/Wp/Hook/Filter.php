<?php

namespace Dgm\Wp\Hook;
use Dgm\Wp\IHook;
class Filter extends Base implements IHook {
    public function getType(): string {
        return IHook::HOOK_FILTER;
    }
    
    public function attach(callable $handler) {
        add_filter($this->getHook(), $handler, $this->getPriority(), $this->getArgCount());
    }
}
