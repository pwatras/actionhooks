<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Dgm\Wp\ActionHooks\State\TriggerProvider;
use Dgm\Wp\ActionHooks\State\ITriggerProvider;
use Dgm\Wp\ITrigger;
use Dgm\Wp\IHook;
use Dgm\Wp\Trigger;
use Dgm\Wp\Hook;
class FileJson implements ITriggerProvider {
    private $path;
    private $dispatcherInstance;
    private $parsed = null;
    private const DEFAULT_TRIGGER_OPTS = [];
    
    function __construct(string $path, \Dgm\Wp\ActionHooks\TriggerRequest\IDispatcher $dispatcher) {
        $this->path = $path;
        $this->dispatcherInstance = $dispatcher;
    }
    
    public function getAll(): \Dgm\Wp\Trigger\ITriggerCollection {
        if(is_null($this->parsed)) {
            $this->parsed = $this->parse();
        }
        return $this->parsed;
    }
    
    protected function parse() {
        if(!is_readable($this->path)) { throw new \Exception('Cannot read '.$this->path); }
        $data = json_decode(file_get_contents($this->path),true);
        if(is_null($data)) { throw new \Exception('Cannot parse '.$this->path.' expected json format'); }
        if(!is_array($data)) { throw new \Exception('Cannot parse '.$this->path.' contents. Expected array'); }
        $triggers = [];
        foreach($data as $item) {
            array_push($triggers,$this->parseArrayItem($item));
        }
        return new Trigger\TriggerCollection(...$triggers);
    }
    
    protected function parseArrayItem(array $item):ITrigger {
        $hookHandle = $item['hook'];
        $priority = isset($item['priority'])?$item['priority']:IHook::DEFAULT_PRIORITY;
        $argCount = isset($item['args'])?$item['args']:IHook::DEFAULT_ARG_COUNT;
        $opts = $this->parseOpts($item);
        $address = \Dgm\Connectivity\Request\Address\Factory::factory($item['address']);
        
        switch($item['type']) {
            case IHook::HOOK_ACTION:
                $hook = new Hook\Action($hookHandle, $argCount, $priority);
                break;
            case IHook::HOOK_FILTER:
                $hook = new Hook\Filter($hookHandle, $argCount, $priority);
                break;
            default:
                throw new \Exception('Unexpected hook type '.$item['type']);
        }
        return Trigger\Factory::create($hook, $address, $this->getDispatcherInstance(), $opts);
    }
    
    protected function getDispatcherInstance(): \Dgm\Wp\ActionHooks\TriggerRequest\IDispatcher  {
        return $this->dispatcherInstance;
    }
    
    protected function parseOpts(array $item): ?\Dgm\IOpts {
        if(!isset($item['options'])) { return null; }
        if(!is_array($item['options'])) { throw new \Exceptions('Cannot parse options field - expected array'); }
        return new \Dgm\Opts($item['options'],self::DEFAULT_TRIGGER_OPTS);
    }
}
