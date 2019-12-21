<?php


namespace Dgm\Wp;

class Settings implements ISettings {
    private $settings;
    private $branches;
    
    function __construct(array $settings,array $branches = []) {
        $this->settings = $settings;
        $this->branches = $branches;
    }


    public function getField(string $key) {
        if(!$this->hasField($key)) {
            throw new \Exception('Field "'.$key.'" does not exist');
        }
        return $this->settings[$key];
    }
    
    public function getOptionalField(string $key, $defaultValue = null) {
        return $this->hasField($key)?$this->settings[$key]:$defaultValue;
    }

    public function getBranch(string $handle): ISettings {
        if(!$this->hasBranch($handle)) {
            throw new \Exception('Branch "'.$handle.'" does not exist');
        }
        return $this->branches[$handle];
    }

    public function hasBranch(string $handle): bool {
        return array_key_exists($handle, $this->branches);
    }
    
    public function hasField(string $key): bool {
        return array_key_exists($key, $this->settings);
    }
    
    public function verifyFields(string ...$requiredFields): bool {
        foreach($requiredFields as $field) {
            if(!$this->hasField($field)) { return false; }
        }
        return true;
    }
    
}
