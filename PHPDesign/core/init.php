<?php
    session_start();

    $GLOBALS['config']=array(
        'mysql'     => array(
            'host'      => '127.0.0.1',
            'username'  => 'root',
            'password'  =>'@gemmaerindan13',
            'db'        => 'php_site'
        ),
        'remember'  => array(
            'cookie_name'   => 'hash',
            'cookie_expiry' => 604800
        ),
        'session'   => array(
            'session_name'  => 'user',
            'token_name'    => 'token'
        )
    );

    spl_autoload_register(function($class){
        try{
            require_once 'classes/' .$class .'.php';
        }catch(Exception $e){
            echo $e->getMessage();
        }
    });
    require_once 'functions/sanitize.php';