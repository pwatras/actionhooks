<?php

namespace Dgm\Wp\Trigger;

interface ITriggerCollection /*extends \Iterator*/ {
    //public function current():ITrigger;
    public function attachAll();
}
