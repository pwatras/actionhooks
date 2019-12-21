<?php
namespace Dgm\Connectivity;

interface IRequestDispatcher {
    public function handle(IConnector $connector, IRequest $request):bool;
    public function await();
}
