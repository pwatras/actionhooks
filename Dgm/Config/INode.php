<?php
namespace Dgm\Config;

interface INode {
    public function getPath();
    public function getKey():string;
}
