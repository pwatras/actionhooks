<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Dgm\Wp\Trigger;

use Dgm\Wp\ITrigger;
//use Dgm\Connectivity\IConnection;
use Dgm\Wp\ActionHooks\TriggerRequest\IDispatcher;
use \Dgm\Connectivity\Request\IAddress;
//use Dgm\Connectivity\IConnector;

class Action extends Base implements ITrigger {
    function __construct(\Dgm\Wp\IHook $hook, IAddress $address,  IDispatcher $dispatcher, ?\Dgm\IOpts $opts = null) {
        parent::__construct($hook, $address,$dispatcher, $opts);
        /*if($this->outputEnabled() && $connection->getConnectionType()==IConnector::ASYNC) {
            throw new \Exception('Show output enabled for ASYNC action. Only synchronous action-triggers can show output');
        }*/
    }


    public function handle(...$args) {
        $request = new \Dgm\Wp\ActionHooks\TriggerRequest\Action($this->parseInput($args), $this->getAddress(), $this->outputEnabled());
        $result = $this->dispatcher->handle($request);
        if(!$result) { //error occured
            return;
        }
        if($this->outputEnabled()) {
            echo $this->parseOutput($result);
        }
    }
    
    private function outputEnabled():bool {
        return $this->opts->get('show_output',false); //use false as default value
    }
}
