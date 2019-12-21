<?php

namespace Dgm;

class EnvValidator implements IEnvValidator {
    private $validators = [];
    private $validationDone = false;
    private $hasErrors = false;
    private $hasWarnings = false;
    private $messages = [];
    public function registerValidator(EnvValidatior\IValidator $validator) {
        array_push($this->validators,$validator);
    }
    
    public function automatic() {
        $developerMode = defined('MODE_DEV');
        if(!$this->isValid()) { //check if there are errors
            //we have errors
            $this->displayMessages($developerMode); //display messages (extended in dev-mode)
            die('Errors occured. Script terminated'); //terminate
        } elseif($developerMode && $this->hasWarnings()) { //check for warnings (only in dev mode)
            $this->displayMessages(true);
        }
        
    }

    public function isValid(): bool {
        $this->validate();
        return !$this->hasErrors;
    }
    
    public function hasErrors(): bool {
        $this->validate();
        return $this->hasErrors;
    }

    public function hasWarnings(): bool {
        $this->validate();
        return $this->hasWarnings;
    }

    public function displayMessages(bool $extendedInfo = false) {
        $this->validate();
        echo '<table border="1">';
        echo '<thead><tr>';
        echo '<th>Validator</th>';
        if($extendedInfo) { echo '<th>Description</th>'; }
        echo '<th>Type</th>';
        echo '</tr></thead>';
        echo '<tbody>';
        foreach($this->messages as $message) {
            echo '<tr>';
            echo '<td>'.$message['label'].'</td>';
            if($extendedInfo) { 
                echo '<td>'.$message['description'].'</td>';
                
            }
            echo '<td><strong>'.$message['type'].'</strong><br />'.$this->statusTipHelper($message['type']).'</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    }
    
    protected function validate() {
        if(!$this->validationDone) {
            $this->runValidators();
            $this->validationDone = true;
        }
    }

    private function runValidators() {
        array_walk($this->validators, function(EnvValidatior\IValidator $validator){
            if($validator->validate()) { return; }
            //has error/warning
            if($validator->isRequired()) {
                $this->hasErrors = true;
            } else {
                $this->hasWarnings = true;
            }
            $this->addMessage($validator->isRequired(),
                    $validator->getLabel(),
                    $validator->getDescription()
            );
        });
    }
    
    private function addMessage(bool $isError,string $label,string $description) {
        $msg = [
            'type'=>($isError?'error':'warning'),
            'label'=>$label,
            'description'=>$description
        ];
        array_push($this->messages,$msg);
    }
    
    private function statusTipHelper(string $errorType) {
        switch($errorType) {
            case 'error':
                $tip = '(will not work unless fixed)';
                break;
            case 'warning':
                $tip = '(recommended to fix)';
                break;
            default:
                //only error and warning types are available - this should not be executed
                //display notice about that in developer mode
                $tip = defined('MODE_DEV')?'unexpected message type '.$errorType:'';
                break;
                
        }
        return $tip;

    }
}
