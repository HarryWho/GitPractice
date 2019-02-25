<?php

class User extends Dbh{
    
    private $handler;
    public function __construct(){
        $this->handler = $this->connect();
    }
    public function protect($string){
        $string=mysql_real_escape_string(trim(strip_tags(addslashes($string))));
        return string;
    }
    public function encrypt($string, $key){
        $string=rtrim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256,$key,$string,MCRYPT_MODE_ECB)));

    }
    public function decrypt($string,$key){
        $string = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, base64_decode($string),MCRYPT_MODE_ECB));

    }
    public function hashword($string, $salt){
        return crypt($string, '$1$' .$salt .'$' );
    }

    public function getAllUsers(){
        $stmt = $handler->query("SELECT * FROM users");
        echo "There are ".$stmt->rowCount()." records";
        while($row = $stmt->fetch()){
            echo $row['userName'];
            
        }

    }
    
    public function getUsersWithCountCheck(Array $vals){
      $sql="SELECT * FROM users WHERE userName=?";
        $query=$this->connect()->prepare($sql);

        $query->execute(array($vals));
       
       $result=$query->fetchAll(PDO::FETCH_OBJ);
       return $result->userSalt;
    //     while($r=$query->fetch(PDO::FETCH_OBJ)){
    //         echo "INSIDE!!!!";
    //       return $r; 
    //    }
    } 
    public function insert(Array $vals){
        $placeholder='';
        for($i=0;$i<count($vals);$i++){
            $placeholder.= ($i<(count($vals)-1)) ? '?,':'?';
        }
        $sql="INSERT INTO users (userName, userEmail, userPassword, userSalt) VALUES ($placeholder)";
        
        $query=$handler->prepare($sql);
        $result = $query->execute($vals);
        return $result;
    }
    public function getSalt() {
        $charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789/\\][{}\'";:?.>,<!@#$%^&*()-_=+|';
        $randString = "";
        $randStringLen = 64;
   
        while(strlen($randString) < $randStringLen) {
            $randChar = substr(str_shuffle($charset), mt_rand(0, strlen($charset)), 1);
            $randString .= $randChar;
        }
   
        return $randString;
   }
   public function Login($user, $password){
      
        $query = $this->getUsersWithCountCheck([$user]);
        
        var_dump($query);
   }
}