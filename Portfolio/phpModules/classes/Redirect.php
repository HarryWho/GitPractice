<?php
class Redirect{
    public static function to($location=null){
        // echo $location;
        if($location){
            header('Location: ' .$location);
            exit();
        }
    }

}