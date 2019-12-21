<?php

namespace Dgm;
interface IOpts {
    public function get(string $opt,$defaultValue = null);
    public function hasOpt(string $opt):bool;
}
