<?php
namespace Dgm;

class Opts implements IOpts {
    private $opts;
    private $defaults;
    
    function __construct(array $opts,array $defaults = []) {
        $this->opts = $opts;
        $this->defaults = $defaults;
    }
    
    public function get(string $opt, $defaultValue = null) {
        if($this->hasValue($opt)) {
            return $this->opts[$opt];
        } elseif($this->hasDefault($opt)) {
            return $this->defaults[$opt];
        } else {
            return $defaultValue;
        }
    }
    
    public function hasOpt(string $opt): bool {
        return $this->hasValue($opt) || $this->hasDefault($opt);
    }
    
    /*
     * has actual (not just default) value
     */
    protected function hasValue(string $opt):bool {
        return array_key_exists($opt, $this->opts);
    }

    /*
     * has default value
     */
    protected function hasDefault(string $opt):bool {
        return array_key_exists($opt, $this->defaults);
    }
}
