<?php
namespace Dgm\Wp;
use Dgm\Wp\Trigger\Decorator\IInputDecorator;
use Dgm\Wp\Trigger\Decorator\IOutputDecorator;
interface ITrigger {
    public function attach();
    public function decorateInput(IInputDecorator $decorator);
    public function decorateOutput(IOutputDecorator $decorator);
}
