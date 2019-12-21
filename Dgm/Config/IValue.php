<?php
namespace Dgm\Config;

interface IValue extends INode {
    public function getValue();
    public function toString():string;
    /*public function toString():string;
    public function toInt():int;
    public function toFloat():float;
    public function toArray():array;*/
}
