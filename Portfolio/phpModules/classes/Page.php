<?php 
include_once '../core/init.php';
class Page{
    private $_path = array();//$_db,
            
    public function __construct($path = null){
        //$this->_db = DB::getInstance();
        $this->_path =$path;
        $this->_path[0] = 'home';
    }
    public function get(){
        return $this_path;
    }
    public function first(){
        if(!$this->_path[1])
            return 'home';
        else
            return $this->_path[1];
    }
    public function second(){
        return $this->_path[2];
    }
    public function third(){
        return $this->_path[3];
    }
    public function forth(){
        return $this->_path[4];
    }
    public function seperator(){
        if(count($this->_path)>2)
            return " / ";
    }
}