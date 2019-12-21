<?php

namespace Dgm\Wp\Trigger;
use Dgm\Wp\ITrigger;
use Dgm\IOpts;
use Dgm\Wp\IHook;
//use Dgm\Wp\IConnector;
//use Dgm\Connectivity\IConnection;
use Dgm\Connectivity\Request\IAddress;
use Dgm\Wp\ActionHooks\TriggerRequest\IDispatcher;


abstract class Base implements ITrigger {
    protected $hook;
    protected $dispatcher;
    protected $opts;
    
    private $address;
    private $inputDecorators = [];
    private $outputDecorators = [];
    
    function __construct(IHook $hook, IAddress $address,IDispatcher $dispatcher,?IOpts $opts = null) {
        $this->hook = $hook;
        $this->dispatcher = $dispatcher;
        $this->opts = is_null($opts)?new \Dgm\Opts([]):$opts;
        $this->address = $address;
    }
    
    public function attach() {
        $this->hook->attach([$this,'handle']);
    }
    
    public function decorateInput(Decorator\IInputDecorator $decorator) {
        array_push($this->inputDecorators,$decorator);
    }
    public function decorateOutput(Decorator\IOutputDecorator $decorator) {
        array_push($this->outputDecorators,$decorator);
    }
    

    abstract public function handle(...$args);
    //protected abstract function execute(array $args);
    protected function parseInput(array $args):array {
        array_walk($this->inputDecorators,function(Decorator\IInputDecorator $decorator) use(&$args) {
            $args = $decorator->decorate($args);
        });
        return $args;
    }
    
    protected function parseOutput($output) {
        array_walk($this->outputDecorators,function(Decorator\IOutputDecorator $decorator) use(&$output) {
            $output = $decorator->decorate($output);
        });
        return $output;
    }
    
    protected function getAddress():IAddress { return $this->address; }

}
