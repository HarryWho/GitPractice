<?php
session_start();
$GLOBALS['config']=array(
    'mysql' => array(),
    'remember' => array(),
    'session' => array(
        'session_name' => 'user',
        'token_name'   => 'token'
    )

);
spl_autoload_register(function($class){
    try{
        require_once 'php/classes/' .$class .'.php';
    }catch(Exception $e){
        echo $e->getMessage();
    }
});