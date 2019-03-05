<?php
if(Input::exists()){
    if(Token::check(Input::get('token'))){
        $validate = new Validate();
        $validation = $validate->check($_POST,array(
            'userName' => array('required' => true),
            'userPassword' => array('required' => true)
        ));
        if($validation->passed()){
            $user = new User();
            $login = $user->login(Input::get('userName'), Input::get('userPassword'));
            if($login){
                Redirect::to('/?p='.md5('home'));
            }else{
                echo "Login Failed!!";
            }
        }else{
            foreach($validation->errors() as $error){
                echo $error .'</br>';
            }
        }
    }
}
?>
<div class="form-container">
    <div class="container">
        <h1>Login</h1>
        <form action="/?p=<?php echo Input::get('p') ?>" method="POST">
            <input type="text" name="userName" id="username" placeholder="Enter Username">
            <input type="password" name="userPassword" id="password" placeholder="Enter Password">
            <label for="remember">Remember Me
            <input type="checkbox" name="remember" id="remember" /></label>
            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
            <input type="submit" value="Login">
        </form>
    </div>
</div>