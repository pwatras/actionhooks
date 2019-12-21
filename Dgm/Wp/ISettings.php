<?php
namespace Dgm\Wp;

interface ISettings {
    public function getBranch(string $handle):ISettings;
    public function hasBranch(string $handle):bool;
    public function getField(string $key);
    public function getOptionalField(string $key,$defaultValue = null);
    public function hasField(string $key):bool;
    public function verifyFields(string ...$requiredFields):bool;
}
