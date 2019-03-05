<?php
     $errors='';
    if(Input::exists()){
        if(Token::check(Input::get('token'))){
            
            $validate = new Validate();
            $validation = $validate->check($_POST, array(
                'userName' => array(
                    'require'   => true,
                    'min'       => 3,
                    'max'       => 20,
                    'unique'    => 'users'
                ),
                'userEmail' => array(
                    'required' => true
                    
                ),
                'userPassword' => array(
                    'required'  => true,
                    'min'       => 6
                ),
                'repassword' => array(
                    'required' => true,
                    'matches'  => 'userPassword'
                )
            ));

            if($validation->passed()){
                $user = new User();

                $salt = Hash::salt(16);
               
                try{
                    $user->create(array(
                        "userName" => Input::get('userName'),
                        "userEmail" => Input::get('userEmail'),
                        "userPassword" => Hash::make(Input::get('userPassword'), bin2hex($salt)),
                        "userSalt" => bin2hex($salt),
                        "userJoined" => date('Y-m-d H:i:s'),
                        "userGroup" => 1
                    ));
                    Session::flash('success', 'You have been registered and can now log in');
                   
                    Redirect::to('/?p='.md5('home'));
                }catch(Exception $e){
                    die($e->getMessage());
                }
            }else{
                // output errors
                $errors= "
                    <div class='error'>
                        <ul>
                    ";
                foreach($validation->errors() as $error){
                    
                    $errors.= '<li>'.$error.'</li>';
                    
                }
                $errors.= "</ul>
                    </div>";
            }
        }
    }
?>

<div class="form-container">
    <div class="container">
        <h1>Register</h1>
        <form action="?p=<?php echo Input::get('p') ?>" method="POST">
            <input type="hidden" name="p" value="<?php echo Input::get('p') ?>">
            <input type="text" name="userName" id="username" placeholder="Enter Username" value="<?php echo Input::get('userName') ?>">
            <input type="email" name="userEmail" id="email" placeholder="Enter Email" value="<?php echo Input::get('userEmail') ?>">
            <input type="password" name="userPassword" id="password" placeholder="Enter Password" value="<?php echo Input::get('userPassword') ?>">
            <input type="password" name="repassword" id="repassword" placeholder="Re-Enter Password">
            <input type="hidden" name="token" value="<?php echo Token::generate() ?>">
            <input type="hidden" name="year" value="<?php echo Input::get('year') ?>">
            <input type="hidden" name="month" value="<?php echo Input::get('month') ?>">

            <input type="submit" value="Register">
            
        </form>
        
    </div>
    <?php if($errors){echo $errors;} ?>
</div>