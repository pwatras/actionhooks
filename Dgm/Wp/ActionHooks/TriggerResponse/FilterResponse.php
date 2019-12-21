<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Dgm\Wp\ActionHooks\TriggerResponse;

class FilterResponse implements IFilterResponse {
    private $triggers;
    private $data;
    
    function __construct($data,array $triggers = []) {
        $this->data = $data;
        $this->triggers = $triggers;
    }


    public function getData() {
        return $this->data;
    }

    public function hasTriggers(): bool {
        return count($this->triggers)>0;
    }
    
    public function getTriggers(): array {
        return $this->triggers;
    }
}
