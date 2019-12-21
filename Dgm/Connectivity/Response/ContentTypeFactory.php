<?php

namespace Dgm\Connectivity\Response;

abstract class ContentTypeFactory {
    public static function create(string $contentType):IContentType {
        $parts = explode(';',$contentType);
        $boundary = null;
        $charset = IContentType::DEFAULT_CHARSET;
        for($i=1;$i<count($parts);$i++) {
            list($varname,$value) = explode('=',$parts[$i]);
            if(!isset($value)) { continue; }
            if($varname=='boundary') {
                $boundary = $value;
            } elseif($varname=='charset') {
                $charset = $value;
            }
        }
        return new MimeContentType(
            empty($parts[0])?IContentType::DEFAULT_CONTENT_TYPE:$parts[0],
            $charset,
            $boundary
        );
    }
}
