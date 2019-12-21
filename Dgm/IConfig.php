<?php

namespace Dgm;
use Dgm\Config;


interface IConfig {
    const SEPARATOR = '/';
    public function getValue(string $path):Config\IValue;
    public function getSection(string $path):Config\ISection;
    public function getNode(string $path):Config\INode;
}
