<?php
namespace Dgm\Wp\ActionHooks\TriggerResponse\Parser;
use Dgm\Wp\ActionHooks\TriggerResponse\IParser;
use Dgm\Wp\IHook;
interface IDispatcher extends IParser {
    const TYPE_ACTION = IHook::HOOK_ACTION;
    const TYPE_FILTER = IHook::HOOK_FILTER;
    const TYPE_ACTION_FILTER = 'both';
    public function addParser(IParser $parser,string $enumType);
}
