<?php

namespace Dgm\Connectivity;

interface IResponse {
    public function getContentType(): Response\IContentType;
    public function getContentString():string;
    public function getMeta():array;
    public function getMetaField(string $fieldName):?string;
}
