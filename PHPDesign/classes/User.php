<?php
class User{
    private $_db,
            $_data,
            $_sessionName,
            $_isLoggedIn;
    public function __construct($user = null){
        $this->_db=DB::getInstance();
        $this->_sessionName = Config::get('session/session_name');
        if(!$user){
            if(Session::exists($this->_sessionName)){
                $user=Session::get($this->_sessionName);
                
            }else{
                $user=27;
            }
            if($this->find($user)&&$user!=27){
                $this->_isLoggedIn =true;
            }else{
                /// process logout
            }
        }else{
            $this->find($user);
        }

    }
    public function isLoggedIn(){
        return $this->_isLoggedIn;
    }
    public function create($fields = array()){
       
        if(!$this->_db->insert('users', $fields)){
            throw new Exception('There was a problem creating account');
        }
    }
    public function find($user = null){
        if($user){
            $field = (is_numeric($user)) ? 'userId' : 'userName';
            $data = $this->_db->get('users', array($field, '=', $user));

            if($data->count()){
                $this->_data = $data->first();
                return true;
            }
        }
        return false;
    }
    public function login($username = null, $password = null){
        $user = $this->find($username);
        if($user){
            if($this->data()->userPassword === Hash::make($password, $this->data()->userSalt)){
                Session::put($this->_sessionName, $this->data()->userId);
                return true;
            }
        }
        return false;
    }
    public function data(){
        return $this->_data;
    }
}