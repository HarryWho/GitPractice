<?php
    require_once 'phpModules/core/init.php';
    
    if(!Session::exists(Config::get('session/session_name'))){
        $user = new User('22');
        Session::put(Config::get('session/session_name'), $user->data()->userId);
    }
    $user = new User();
      // echo $user->data()->userName;
    
    $menu = new Menu();
    $my_menu = $menu->get('menus','menuPermission',$user->data()->userGroup);
    
    
    $path=new Path();
    //url_origin( $_SERVER, false ) . $_SERVER['REQUEST_URI'];
    if($path->path()[1]==="logout"){
        $user->logout();
        Redirect::to('/');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Side Menu</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo $path->path()[0] ?>/css/style.css">
</head>
<body>
<!-- Top Navigation Bar -->
    <nav class="navbar">
        <span class="open-slide" id="open-slide">
            <a href="#" onclick="chooseDirection()">
                 
                &#9776;
            </a>
        </span>
        <div class="brand">
            <h1>PHP Planet</h1>
        </div>
        <ul class="navbar-nav">
            <li><a href="#"><i class="far fa-comment-alt"></i></a></li>
            <li><a href="#"><i class="far fa-envelope"></i></a></li>
            <li><a href="#"><i class="fas fa-user"></i></a>
                <ul>
                    <li>
                        <div class="profile">
                            <h1>Welcome <?php echo $user->data()->userName ?></h1>
                            <div class="inline">
                                <?php if(!$user->isLoggedIn()){ ?>
                                    <a href="#openModal" class="btn btn-md">Login</a>
                                    <a href="#registerModal" class="btn btn-md">Register</a>
                                <?php }else{ ?>
                                    <a href="/logout" class="btn btn-md">Logout</a>
                                    <a href="#" class="btn btn-md">Profile</a>
                                <?php } ?>
                            </div>
                        </div>
                        

                    </li>
                </ul>
            </li>
            <li><a href="#"><i class="fas fa-cogs"></i></a></li>
        </ul>
    </nav>
<!-- End Top Navigation -->

<!-- Side Menu -->
    <div id="side-menu" class="side-nav">
        
        <div class="menu-divs">
            <div class="opened-menu" id="opened-menu">
                
                <?php
                    echo "<ul>";
                        include_once "phpModules/includes/side_menu.php";
                    echo "</ul>";
                ?>
            </div>
           
        </div>
    </div>
    <div id="main">
       
            <div class="page-header">
               
                <div class="page-tracker">
                    <?php //echo $user->data()->userName; 
                        
                        echo $path->print_path();
                         
                       
                    ?>
                </div>
            </div>
            
       
        <div class="content">
            <?php  
                //echo $path->path()[1];
                $page = new Page($path->path());
                switch($page->first()){
                    case "administrator":
                        include_once "phpModules/includes/admin.php";
                    break;
                    default:
                        echo "everything else";
                    break;
                }
                // echo $page->first().$page->seperator().$page->second();
                
            ?>
            
        </div>
    </div><!-- END MAIN DIV-->
<!-- End Side Menu -->

    
<!-- Alert Message -->
            <?php 
                
                if(Session::exists('home')){ ?>
                <div class="alert alert-success">
                        
                        <?php
                    echo Session::flash('home');   ?>
                </div>
            <?php } ?>
        </div> 
<!-- End Alert -->
    

<!-- Modals -->
            <div id="registerSuccessModal" class="modalDialog">
                
                <div>
                    <a href="#close" title="Close" class="close">X</a>
                    <div id="title">
                        <h2>Success</h2>
                    </div> 
                    <div id="content">
                        
                    </div>
                </div>
            </div>
            <input type="hidden" name="token" id="token" value="<?php echo Token::generate() ?>">
    <?php if(!$user->isLoggedIn()){ ?>
        
        <!-- LOGIN -->

            <div id="openModal" class="modalDialog">
            <input type="hidden" name="type" value="login">
                <div>
                    <a href="#close" title="Close" class="close">X</a>
                    <h2>Login</h2>
                    
                    <input type="text" name="username" id="username" placeholder="Enter Username">
                    <span id="usernameError"></span>
                    <input type="password" name="password" id="password" placeholder="Enter Password">
                    <span id="passwordError"></span>
                    <div class="inline">
                        <a href="#openModal" onclick="loginUser()" class="btn btn-md">Login</a>
                        <a href="#registerModal" class="btn btn-md">Don't have an account yet?</a>
                    </div>
                            
                </div>
            </div>
        
        <!-- REGISTER -->
            <div id="registerModal" class="modalDialog">
                <div>
                    <input type="hidden" name="type" value="register">
                    <a href="#close" title="Close" class="close">X</a>
                    <h2>Register</h2>
                    
                    <input type="text" name="username" id="regusername" placeholder="Enter Username" required>
                    <span id="usernameError"></span>
                    <input type="email" name="email" id="email" placeholder="Enter Email" required>
                    <span id="emailError"></span>
                    <input type="password" name="password" id="regpassword" placeholder="Enter Password" required>
                    <span id="passwordError"></span>
                    <input type="password" name="repassword" id="regrepassword" placeholder="Re-Enter Password" required>
                    <span id="repasswordError"></span>
                    
                    <div class="inline">
                        <a href="#registerModal" class="btn btn-md" onclick="registerUser()">Register</a>
                        <a href="#openModal" class="btn btn-md">Already have an account?</a>
                    </div>
                            
                </div>
            </div>
        
       
            
            <script src="js/login.js"></script>
        <script src="js/register.js"></script>
    <?php }else{ ?>
        <script src="js/logout.js"></script>
    <?php } ?>
    <script src="js/animation.js"></script>
<!-- End Modals -->
</body>
</html>