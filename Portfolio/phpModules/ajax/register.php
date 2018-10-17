<?php
    $username=$_POST['username'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $msg="<p>Welcome ".$_POST['username']."</p><p><br/>You Have successfully registered with this site</p><p><br/>An email has been sent to the following address ".$email.".</p><p><br />Please follow the link to verify</p><p><br /><a href='#close' class='btn btn-md btn-success'>Ok</a></p>";
    echo "Success:$msg";

