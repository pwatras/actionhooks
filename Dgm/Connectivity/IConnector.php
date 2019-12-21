<?php
namespace Dgm\Connectivity;

interface IConnector {
    const ASYNC = 'async';
    const SYNC = 'sync';
    const DEFAULT_CONNECTION_TYPE = self::SYNC;
    public function call(IRequest $request);
    public function await();
    public function getResponse(): IResponse;
    public function isError():bool;
    public function getError():string;
    public function getType():string;
    public static function factory(string $connectorType):IConnector;
}
