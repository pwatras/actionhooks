<?php
namespace Dgm\EnvValidator;

interface IValidator {
    public function getLabel():string;
    public function getDescription():string;
    public function isRequired():bool; //true: will not work, false: will work but warn
    public function validate():bool;
}
