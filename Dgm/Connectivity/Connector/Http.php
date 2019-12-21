<?php
namespace Dgm\Connectivity\Connector;
use Dgm\Connectivity\IConnector;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Client;
abstract class Http implements IConnector {
    private static $httpCli = null;
    private $type;
    protected $myuuid;
    
    function __construct(string $type = IConnector::ASYNC) {
        $this->type = $type;
    }
    
    public function getType(): string {
        return $this->type;
    }

    protected static function getClient():Client {
        if(is_null(self::$httpCli)) {
            self::$httpCli = new Client();
        }
        return self::$httpCli;
    }
    
    protected function getHeaderData(ResponseInterface $res):array {
        $data = [];
        foreach($res->getHeaders() as $headerName=>$headerValues) {
            $data[$headerName] = implode(' , ',$headerValues);
        }
        return $data;
    }
    
}
