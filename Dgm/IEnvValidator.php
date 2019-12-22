<?php
namespace Dgm;

interface IEnvValidator {
    public function registerValidator(EnvValidator\IValidator $validator);
    public function isValid():bool;
    public function hasWarnings():bool;
    public function hasErrors():bool;
    public function displayMessages(bool $extendedInfo = false);
    public function automatic();
}
