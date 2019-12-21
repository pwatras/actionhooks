<?php

namespace Dgm\Connectivity;

class Response implements IResponse {
    private $meta;
    private $content;
    private $contentType;
    
    function __construct(string $content,array $meta = [],string $contentType = null) {
        $this->meta = $meta;
        $this->content = $content;
        if(is_null($contentType)) {
            $contentType = array_key_exists('Content-Type', $meta)?$meta['Content-Type']:'';
        } 
        $this->contentType = Response\ContentTypeFactory::create($contentType);
    }
    
    public function getContentType(): Response\IContentType {
        return $this->contentType;
    }

    public function getContentString(): string {
        return $this->content;
    }
    
    public function getMeta(): array {
        return $this->meta;
    }
    
    public function getMetaField(string $fieldName): ?string {
        return array_key_exists($fieldName, $this->meta)?$this->meta[$fieldName]:null;
    }
    
    
}
