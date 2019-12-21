<?php
namespace Dgm\Config;
use Dgm\IConfig;
abstract class Node implements INode {
    private $rootPath;
    private $key;
    
    function __construct(string $nodeKey,string $rootPath = '') {
        $this->rootPath = $rootPath;
        $this->key = $nodeKey;
    }
    
    public function getPath() {
        return $this->rootPath.IConfig::SEPARATOR.$this->key;
    }
    
    public function getKey(): string {
        return $this->key;
    }
}
