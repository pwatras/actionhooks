<?php


namespace Dgm\Config;

class Section extends Node implements ISection {
    private $children = [];
    
    public function addChildNode(INode $node) {
        $this->children[$node->getKey()] = $node;
    }
    
    public function getChild(string $key): ?INode {
        return $this->hasChild($key)?$this->children[$key]:null;
    }
    
    public function hasChild(string $key): bool {
        return array_key_exists($key, $this->children);
    }

    public function getChildren(): array {
        return $this->children;
    }
    
}
