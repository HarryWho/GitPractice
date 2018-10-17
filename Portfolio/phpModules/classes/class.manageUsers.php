<?php
    include "database.php";

    class User {
        /* Properties */
        private $conn;
    
        /* Get database access */
        public function __construct() {
            $this->conn = new Database();
        }
    
        /* Login a user */
        public function login() {
            $stmt = $this->conn->prepare("SELECT username, usermail FROM user");
            if($stmt->execute()) {
                while($rows = $stmt->fetch()) {
                    $fetch[] = $rows;
                }
                return $fetch;
            }
            else {
                return false;
            }
        }
    }
?>