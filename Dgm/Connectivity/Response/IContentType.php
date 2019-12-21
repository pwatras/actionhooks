<?php
namespace Dgm\Connectivity\Response;

interface IContentType {
    const DEFAULT_CHARSET = 'utf-8';
    const DEFAULT_CONTENT_TYPE = 'text/plain';
    public function getType():string;
    public function getCharset():string;
    public function getBoundary():?string;
}
