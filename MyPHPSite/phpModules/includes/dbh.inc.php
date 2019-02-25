<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Dbh{
    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $charset;
    public function connect(){
        $this->servername ="localhost";
        $this->username ="root";
        $this->password ="@gemmaerindan13";
        $this->dbname ="php_site";
        $this->charset ="utf8mb4";
       
        try {
            $dsn = "mysql:host=".$this->servername.";dbname=".$this->dbname.";charset=".$this->charset;
            $pdo = new PDO($dsn,$this->username, $this->password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            return $pdo; 
        } catch (PDOException $e) {
            //throw $th;
            echo "Connection Failed: " . $e->getMessage();
        }
       


    }
}