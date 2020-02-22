<?php

namespace Dgm\Connectivity\Connector;
use Dgm\Connectivity\IConnector;
use Dgm\Connectivity\IRequest;
use Dgm\Connectivity\IResponse;
use Dgm\Connectivity\Response;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;


class HttpPost extends Http implements IConnector {
    private $promise;
    private $response = null;
    private $hasError = false;
    private $error = null;
    private const STATUS_OK = [200];
    public static function factory(string $connectorType): \Dgm\Connectivity\IConnector {
        return new self($connectorType);
    }

    public function call(IRequest $request) {
        $cli = self::getClient();
        //$this->promise = $cli->postAsync($uri)
        $httpReq = new Request('POST',$request->getAddress()->toString(),['Content-type'=>'application/json'],$request->getContent());
        var_dump($request->getContent());
        $this->promise = $cli->sendAsync($httpReq);
        $this->promise->then(
            function (ResponseInterface $res) {
                //echo $res->getStatusCode() . "\n"; //TODOcheck if 200
                //var_dump($res->getStatusCode());
                //var_dump($res->getReasonPhrase());
                if(in_array($res->getStatusCode(), self::STATUS_OK)) {
                    $this->response = new Response($res->getBody()->getContents(),$this->getHeaderData($res));
                } else {
                    $this->setErrorMessage('Http status '.$res->getStatusCode());
                }
            },
            function (RequestException $e) {
                $this->setErrorFromException($e);
            }
        );
    }
    

    public function await() {
        try {
            $this->promise->wait();
        } catch(\Exception $ex) {
            $this->error = $ex->getMessage();
        }
    }
    
    public function isError(): bool {
        return $this->hasError;
    }
    
    public function getError(): string {
        return $this->error;
    }
    
    public function getResponse(): IResponse {
        return $this->response;
    }
    
    protected function setErrorMessage(string $errorMessage) {
        $this->error = $errorMessage;
        $this->hasError = true;
    }
    
    protected function setErrorFromException(\Exception $ex) {
        $this->setErrorMessage($ex->getMessage());
    }
}
