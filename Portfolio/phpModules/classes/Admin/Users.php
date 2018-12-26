
<?php
class Users{
        private $_db = null,
                $_users = array();
        public function __construct(){
                $this->_db = DB::getInstance();
                
        }
        public function getusers(){
                $this->_db->get('users', array('userId','>','0'));
                $this->_users = $this->_db->results();
                return $this->_users;
        }
        public function getUser($id){
                
                $this->_db->get('users',array('userId', '=', "{$id}"));
                $this->_users = $this->_db->results();
                return $this;
        }
        public function update($table, $id, $fields){
               return $this->_db->update($table, $id, $fields);
        }
        public function addUser($table,$fields){
                return $this->_db->insert($table, $fields);
        }
        public function delete($table,$where){
                return $this->_db->delete($table,$where);
        }
        public function first(){
                return $this->_users[0];
        }
}