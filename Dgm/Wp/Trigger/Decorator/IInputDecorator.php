<?php
namespace Dgm\Wp\Trigger\Decorator;

interface IInputDecorator {
    public function decorate(array $args):array;
}
