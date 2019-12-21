<?php
namespace Dgm\Wp\ActionHooks\TriggerResponse\Parser;

abstract class Builder {
    public static function build():IDispatcher {
        $parser = new Composite();
        $parser->addParser(new AHResponse(), IDispatcher::TYPE_ACTION_FILTER);
        $parser->addParser(new DataResponse(), IDispatcher::TYPE_FILTER);
        $parser->addParser(new Plaintext(), IDispatcher::TYPE_ACTION_FILTER);
        return $parser;
    }
}
