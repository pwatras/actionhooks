<?php

namespace Dgm\Wp\ActionHooks\EnvValidators;
use Dgm\EnvValidator\IValidator;

class CurlExtension implements IValidator {
    public function getLabel(): string {
        return 'curl-extension';
    }
    
    public function getDescription(): string {
        return 'PHP Extension curl';
    }
    
    public function isRequired(): bool {
        return false; //curl is required for running guzzle async connections in parallel. Guzzle will work without it however.
    }
    
    public function validate(): bool {
        return extension_loaded('curl');
    }
}
