<?php

namespace Dgm\Wp\Trigger;
//use Dgm\Wp\ITrigger;
interface ITriggerCollection /*extends \Iterator*/ {
    //public function current():ITrigger;
    public function attachAll();
}
