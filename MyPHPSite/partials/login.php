<?php
    if(isset($_POST['name'])){
        $name=$_POST['name'];
        $password = $_POST['password'];
       
        $user= new User();
        echo $user->Login($name,$password);
    }
?>
<div class="container">
    <div class="form">
        <form action="/login" method="post">
            <input type="text" name="name" id="name" placeholder="Enter Username">
            <input type="password" name="password" id="password" placeholder="Enter Password">
            <div class="inputs">
                <input type="submit" value="Login">
                <input type="button" value="Register" onclick="document.location='/register'">
            </div>
        </form>
    </div>
</div>