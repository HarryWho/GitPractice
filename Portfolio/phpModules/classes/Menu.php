<?php
include_once '../core/init.php';
class Menu{
    private $_db,
            $_menu = array();
    public function __construct(){
        $this->_db = DB::getInstance();
        
    }

    public function get($table, $field, $value){
        
        $this->_db->get($table, array($field, '<=', $value)); 
        $this->_menu = $this->_db->results();
        
        return $this;
        
    }

    public function menu(){
        
        return $this->_menu;
    }
    public function count(){
        
        return count($this->_menu);
    }
    public function equals($case1, $case2){
        
        if(trim($case2)==="")
            $case2='home';
        return (strtoupper($case1) === strtoupper($case2)) ? "active" : "";
    }
}



