<?php
    require_once 'phpModules/core/init.php';
    if(!Session::exists('user')){
        Session::put('user','Guest');
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
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav class="navbar">
        <span class="open-slide" id="open-slide">
            <a href="#" onclick="chooseDirection()">
               
                &#9776;
            </a>
        </span>
        <div class="brand">
            <h1>My Site</h1>
        </div>
        <ul class="navbar-nav">
            <li><a href="#"><i class="far fa-comment-alt"></i></a></li>
            <li><a href="#"><i class="far fa-envelope"></i></a></li>
            <li><a href="#"><i class="fas fa-user"></i></a>
                <ul>
                    <li>
                        <div class="profile">
                            <h1>Welcome <?php echo Session::get('user') ?></h1>
                            <div class="inline">
                                <a href="#openModal" class="btn btn-md">Login</a>
                                <a href="#registerModal" class="btn btn-md">Register</a>
                            </div>
                        </div>
                        

                    </li>
                </ul>
            </li>
            <li><a href="#"><i class="fas fa-cogs"></i></a></li>
        </ul>
    </nav>
    <div id="side-menu" class="side-nav">
        <div class="opened-menu" id="opened-menu">
            <!-- <a href="#" class="btn-close" id="btn-close" onclick="closeSlideMenu()">&times;</a> -->
            <a href="#">Home</a>
            <a href="#">About</a>
            <a href="#">Services</a>
            <a href="#">Contact</a>
        </div>
        <div class="closed-menu" id="closed-menu">
            <a href="#"><i class="fas fa-home"></i></a>
            <a href="#"><i class="fas fa-info-circle"></i></a>
            <a href="#"><i class="fas fa-concierge-bell"></i></a>
            <a href="#"><i class="fas fa-envelope"></i></a>
        </div>

    </div>
    <div id="main">
        <div>
            <h1>Responsive side menu</h1>
            <?php 
                //echo Config::get('mysql/host');
                // $user = DB::getInstance()->get('users', array('userName', '=', 'Calvin')); 
                // $user=DB::getInstance()->update('users', 3, array(
                //     'userPassword' => 'newpassword',
                //     'userEmail' => 'willthisdo42@hotmail.com'
                    
                // ));
                // if(!$user->count()){
                //     echo 'No User';
                // }else{
                //     echo $user->count();
                // }
            ?>
        </div>
    </div>
    <?php if(!$_SESSION['logedin']){ ?>
        <form action="/" method="post">
        <input type="hidden" name="type" value="login">

            <div id="openModal" class="modalDialog">
                <div>
                    <a href="#close" title="Close" class="close">X</a>
                    <h2>Login</h2>
                    
                    <input type="text" name="username" id="username" placeholder="Enter Username">
                    
                    <input type="password" name="password" id="password" placeholder="Enter Password">
                    <div class="inline">
                        <a href="#" onclick="loginUser()" class="btn btn-md">Login</a>
                        <a href="#registerModal" class="btn btn-md">Don't have an account yet?</a>
                    </div>
                            
                </div>
            </div>
        </form>
        <form action="/" method="post">
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
                    <input type="hidden" name="token" id="token" value="<?php echo Token::generate(); ?>">
                    <div class="inline">
                        <a href="#registerModal" class="btn btn-md" onclick="registerUser()">Register</a>
                        <a href="#openModal" class="btn btn-md">Already have an account?</a>
                    </div>
                            
                </div>
            </div>
        </form>
       
            <div id="registerSuccessModal" class="modalDialog">
                
                <div>
                    <a href="#close" title="Close" class="close">X</a>
                    <div id="title">
                        <h2>Success</h2>
                    </div> 
                    <div id="content">
                        <?php
                            if(Session::exists('success')){
                               
                                echo Session::flash('success');
                                
                            }
                        ?>
                    </div>
                </div>
            <div>
        
        <script src="js/script.js"></script>
    <?php } ?>
    <script src="js/animation.js"></script>
    
</body>
</html>