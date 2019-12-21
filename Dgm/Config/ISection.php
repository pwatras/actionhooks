<?php
namespace Dgm\Config;

interface ISection extends INode {
    public function getChildren():array;
    public function addChildNode(INode $node);
    public function getChild(string $key):?INode;
    public function hasChild(string $key):bool;
}
