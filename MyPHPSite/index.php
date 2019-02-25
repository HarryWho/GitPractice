<?php
session_start();
  //print_r(PDO::getAvailableDrivers());  
  $_SESSION['loggedin']=false;
 include_once "phpModules/includes/dbh.inc.php";
 include_once "phpModules/includes/user.inc.php";
$paths = explode('/', $_SERVER['REQUEST_URI']);

if($paths[0]=='')
    $paths[0]='Home';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>PHP</title>
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="brand"><h1>PHP Planet</h1></div>
            <div class="menu">
                <ul>
                    <li><a href="/" <?php echo ($paths[0]==$paths[1]||$paths[0]=='Home'&&$paths[1]=='') ? "class='active'" : ""; ?>>Home</a></li>
                    <?php if(!$_SESSION['loggedin']) {?>
                        <li><a href="/login" <?php echo ($paths[1]=='login') ? "class='active'" : ""; ?>>Login</a></li>
                        <li><a href="/register" <?php echo ($paths[1]=='register') ? "class='active'" : ""; ?>>Register</a></li>
                        
                    <?php }else {?>
                        <li><a href="/blog" <?php echo ($paths[1]=='blog') ? "class='active'" : ""; ?>>Blog</a></li>
                        <li><a href="/about" <?php echo ($paths[1]=='about') ? "class='active'" : ""; ?>>About</a></li>
                        <li><a href="/contact" <?php echo ($paths[1]=='contact') ? "class='active'" : ""; ?>>Contact</a></li>
                    <?php } ?>
                </ul>
            </div>
        </nav>
    </header>
    <div class="content-wrapper">
        <div class="breadcrumb">
        
        
        <?php 
        $x=0;
        $pathString='';
            foreach($paths as $path ){
                if($path==="")
                    $path="Home";
                    
                $pathString .= ($x==0&&count($paths)>1 ? "<a href='/'>$path</a>" : $path) . ($x>=count($paths) ? '' : ' / ');
                // if($path==$paths[1]){
                //    // echo $pathString;
                //     return false;
                // }
                $x++;
            }
           
            // echo $pathString;
        ?>
        </div>

        <div class="content">
           <?php
                switch($paths[1]){
                    case "login":
                        include_once "partials/login.php";
                    break;
                    case 'register':
                        include_once "partials/register.php";
                    break;
                    default:
                        echo $_SESSION['loggedin'];
                    break;
                }
           ?>
        </div>
    </div>
</body>
</html>