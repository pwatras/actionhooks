<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Dgm;

class Config implements IConfig {
    private $rootNode = null;
    
    public function getNode(string $path): \Dgm\Config\INode {
        throw new \Exception('Not implemented');
    }
    
    public function getSection(string $path): \Dgm\Config\ISection {
        return $this->getNode($path);
    }
    
    public function getValue(string $path): \Dgm\Config\IValue {
        return $this->getNode($path);
    }

    



    protected function getRootNode():Config\Root {
        return $this->rootNode;
    }
}
