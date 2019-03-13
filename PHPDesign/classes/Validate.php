<?php
class Validate{
    private $_passed = false,
            $_errors = array(),
            $_db     = null;

    public function __construct(){
        $this->_db = DB::getInstance();

    }
    public function check($source, $items = array()){
        foreach($items as $item => $rules){
            foreach($rules as $rule => $rule_value){
                $value = trim($source[$item]);
                if($rule === 'required' && empty($value)){
                    $this->addError("{$item} is required");
                }else if(!empty($value)){
                    switch($rule){
                        case 'min':
                            if(strlen($value) < $rule_value){
                                $this->addError("{$item} must be a minimum of {$rule_value} in length");
                            }
                        break;
                        case 'max':
                            if(strlen($value) > $rule_value){
                                $this->addError("{$item} must be a Maximum of {$rule_value} in length");
                            }
                        break;
                        case 'unique':
                            if($this->_db->get($rule_value,array($item, '=', $value))->count()){
                                $this->addError("{$item} must be {$rule}");
                            }
                        break;
                        case 'matches':
                       // echo "{$rule_value} : {$source[$rule_value]} - {$value} matches {$source[$rule_value]}";
                            if($value!=$source[$rule_value]){

                                $this->addError("Passwords do not match");
                            }
                        break;
                    }
                }
            }
        }
        if(empty($this->_errors)){
             $this->_passed=true;
        }
        return $this;
    }
    private function addError($error){
        $this->_errors[] = $error;
    }
    public function errors(){
        return $this->_errors;
    }
    public function passed(){
        return $this->_passed;
    }
}