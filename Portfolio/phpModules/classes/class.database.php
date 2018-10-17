<?php
class Database {

/* Properties */
private $conn;
private $dsn = 'mysql:dbname=test;host=127.0.0.1';
private $user = 'root';
private $password = '';

/* Creates database connection */
    public function __construct() {
        try {
            $this->conn = new PDO($this->dsn, $this->user, $this->password);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "";
            die();
        }
        return $this->conn;
    }
}

?>