<?php
namespace Dgm\Connectivity\Response;

class MimeContentType implements IContentType {
    private $type;
    private $charset;
    private $boundary;
    
    function __construct(string $type,string $charset = IContentType::DEFAULT_CHARSET,?string $boundary = null) {
        $this->type = $type;
        $this->charset = $charset;
        $this->boundary = $boundary;
    }
    
    public function getType(): string {
        return $this->type;
    }
    
    public function getBoundary(): ?string {
        return $this->boundary;
    }
    
    public function getCharset(): string {
        return $this->charset;
    }
    
}
