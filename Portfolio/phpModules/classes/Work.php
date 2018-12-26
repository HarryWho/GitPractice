<?php
include_once '../core/init.php';
class Work{
    private $_db,
            $_data = array();
    public function __construct(){
        $this->_db = DB::getInstance();
    }

    public function get($table){
        $this->_db->get($table);
        $this->_data=$this->_db->results();
        return $this;
    }

    public function data(){
        return $this->_data;
    }
    public function save($table, $fields){
        if(!$this->_db->insert($table, $fields)){
            throw new Exception('There was a problem creating user account');
            return false;
        }else{
           echo "Success";
           return true;
        }
    }
}