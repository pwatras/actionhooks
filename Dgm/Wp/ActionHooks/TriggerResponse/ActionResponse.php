<?php
namespace Dgm\Wp\ActionHooks\TriggerResponse;

class ActionResponse implements IActionResponse {
    private $triggers = [];
    private $content = null;
    
    function __construct(?string $content = null,array $triggers = []) {
        $this->content = $content;
        $this->triggers = $triggers;
    }


    public function getContent(): string {
        return $this->content;
    }
    
    public function hasContent(): bool {
        return !is_null($this->content);
    }
    
    public function hasTriggers(): bool {
        return count($this->triggers)>0;
    }
    
    public function getTriggers(): array {
        return $this->triggers;
    }
}
