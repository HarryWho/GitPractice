<?php
    include_once "class.database.php";
    class ManageUsers{
         public $link;
         function __construct(){
             $db_connection = new dbConnection();
             $this->link = $db_connection->connect();
                return $this->link;
         }

         function registerUser($username,$email,$password,$time,$date){

         }
    }
