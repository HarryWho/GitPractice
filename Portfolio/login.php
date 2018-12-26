<?php 

require_once 'phpModules/core/init.php';



if(Input::exists()){
//if(Token::check(Input::get('token'))){
    if(Input::get('logout')){        // logout user
        if(Session::exists(Config::get('session/session_name'))){
            Session::delete(Config::get('session/session_name'));
        }
        echo "success";
    }else{                         // login user
        $validate = new Validate();
        $validation = $validate->check($_POST,
                array(
                    'username' => array(
                        'required' => true
                    ),
                    'password' => array(
                        'required' => true
                    )
                )
        );
        if($validation->passed()){
                $user = new User();
                $login = $user->login(Input::get('username'), Input::get('password'));
                if($login){
                
                    echo "success:;";
                }else{
                    echo "Sorry login failed";
                }
        }else{
            
                $fmsg='';
                $x=1;
                foreach($validation->errors() as $msg){
                    
                        $fmsg.=$msg;
                        if($x<count($validation->errors())){
                            $fmsg.=";";
                        }
                        $x++;
                }
                echo $fmsg;
        }
    }
}
