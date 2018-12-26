<?php
class Validate{
    private $_passed = false,
            $_errors = array(),
            $_db = null;
    public function __construct()
    {
       
        $this->_db = DB::getInstance();
        
    }

    public function check($src, $items= array())
    {
      
        foreach($items as $item => $rules){
           
            foreach($rules as $rule => $rule_value){

                $value = trim($src[$item]);
               
                $item=escape($item);
                switch($rule){
                    case "min":
                        if(strlen($value) < $rule_value){
                            $this->addError("{$item}Error:{$item} must be longer than {$rule_value} characters");
                        }
                    break;
                    case 'max':
                        if(strlen($value) > $rule_value){
                            $this->addError("{$item}Error:{$item} must be no longer than {$rule_value} characters");
                        }
                    break;
                    case 'unique':
                        $check = $this->_db->get($rule_value, array($item, '=', $value));
                        if($check->count()){
                            $this->addError("{$item}Error:{$item} already exists");
                        }
                    break;
                    case 'required':
                   
                        if(empty($value)){
                            
                            $this->addError("{$item}Error:{$item} is required");
                        }
                    break;
                    case 'match':
                        if($value != $src[$rule_value]){
                            
                            $this->addError("{$item}Error:{$item} must match {$rule_value}");
                        }
                    break;
                    case 'valid-email':
                    if (!filter_var($value, FILTER_VALIDATE_EMAIL)||empty($value)) {
                        // invalid emailaddress
                        $this->addError("{$item}Error:{$value} is not a valid email");

                    }
                    break;
                }
               
            }
        }
        if(empty($this->_errors)){
            $this->_passed = true;
        }
        return $this;
    }
    private function addError($error)
    {
        $this->_errors[] = $error;
    }
    public function errors()
    {
        return $this->_errors;
    }
    public function passed()
    {
        return $this->_passed;
    }
}