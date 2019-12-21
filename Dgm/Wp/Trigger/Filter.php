<?php
namespace Dgm\Wp\Trigger;
use Dgm\Wp\ITrigger;

class Filter extends Base implements ITrigger  {
    public function handle(...$args) {
        $request = new \Dgm\Wp\ActionHooks\TriggerRequest\Filter($this->parseInput($args), $this->getAddress());
        $result = $this->dispatcher->handle($request);
        if(!$result) { //error occured fallback to no-filter
            return $args[0];
        }
        return $this->parseOutput($result);
    }
}
