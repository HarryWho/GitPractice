<?php
    $name; $email; $password; $repassword; $msg="";
    $salt;
    $insert = new User();
    if(isset($_POST['name'])){
        
        $col='red';
        $name       =$_POST['name'];
        $email      =$_POST['email'];
        $password   =$_POST['password'];
        $repassword =$_POST['repassword'];
        
        if($name==NULL){
            $msg.="Please enter a Username<br />";
            
        }
        if($email == NULL){
            $msg.="Please enter a valid email<BR />";
        }else{
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $msg.="Please enter a valid email<br />";
            }
        }
       if($password==NULL){
           $msg.="Please enter a password<br />";
       }else{
           if($repassword!=$password){
               
               $msg.="Passwords do not match<br />";
           }
           else{
               $salt = $insert->getSalt();
               echo $salt ." :- HERE";
               $password = $insert->hashword($password,$salt);
           }
       }

       if(!$msg){

            $vals=[$name, $email, $password, $salt];
            
            if($insert->insert($vals)){
                $_SESSION['uid'] = $name;
                $_SESSION['loggedin'] = true;

                header('Location: /');
                exit;
            }
        }
    }
?>
<div class="container">
    
    <div class="form">
    <?php if($msg){
        echo "<div class='message'>";
        echo $msg;
        echo "</div>";
        
    }?>
        <form action="/register" method="post">
            <input type="text" name="name" id="name" placeholder="Enter Username" value="<?php echo $name ?>">
            <input type="email" name="email" id="email" placeholder="Enter Email" value="<?php echo $email ?>" required>
            <input type="password" name="password" id="password" placeholder="Enter Password">
            <input type="password" name="repassword" id="repassword" placeholder="Re-Password">
            <div class="inputs">
                <input type="submit" value="Register">
                <input type="button" value="Login" onclick="document.location='/login'">
            </div>
        </form>
    </div>
</div>
