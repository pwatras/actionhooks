<?php



namespace Dgm\Config;

class Root extends Section implements ISection,IRoot {
    function __construct() {
        parent::__construct('', '');
    }
}
