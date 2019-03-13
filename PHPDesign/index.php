<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    include "core/init.php";
    if(!Session::exists('uid')){
        Session::put('uid', 'Guest');
    }
    if(!Input::exists('get')){
        $month=date('m');
        $year=date('Y');
    }else{
        $month=Input::get('month');
        $year=Input::get('year');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="nav-wrapper">
    <nav>
        <div class="brand"><h2>Site</h2></div>
        <div class="menu">
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div>
    </nav>
</div>
    <div class="calendar-wrapper">
        <?php
            $calendar = new Calendar($month,$year);
            echo $calendar->show();
        ?>
    </div>
</body>
</html>