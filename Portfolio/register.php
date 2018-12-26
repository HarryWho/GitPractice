<?php
        require_once 'phpModules/core/init.php';
        
    if(Input::exists()){
        // if(Token::check(Input::get('token'))){
        //     Input::get('token')." --- ". Session::get('token');
       //  full_url( $_SERVER ) ;
            $validate = new Validate();
        
            $validation = $validate->check($_POST, array(
                    'username' => array(
                        'required' => true,
                        'min' => 3,
                        'max' => 20,
                        'unique' =>'users'
                    ),
                    'password' => array(
                        'required' => true,
                        'min' => 6
                    ),
                    'email' => array(
                        
                        'valid-email' => true
                    ),
                    'repassword' => array(
                        'match' => 'password'
                    )


            ));
        
            if($validation->passed()){
                $user = new User();
                //$salt = Hash::salt(32);
               
                try{
                   if($user->create(array(
                        'userName' => Input::get('username'),
                        'userEmail' => Input::get('email'),
                        'userPassword' => Hash::make(Input::get('password')),
                        'userSalt' => '',
                        'userJoined' => date('Y-m-d H:i:s'),
                        'userGroup' => 1
                    ))){
                        //Session::put('username', Input::get('username'));
                        Session::flash('home',
                            "<p>Thank you " .Input::get('username') ." </p><p>You have successfully registered</p>
                            <p>
                            <br />
                                We have sent an email to the following address
                            </p>
                            <p>
                            <br />".
                                Input::get('email')
                            ."</p>
                            <p>
                            <br />
                                Please follow the link sent in the email to validate you subscription
                            </p>
                            <p>
                            <br />
                                <a href='/' class='btn btn-md btn-success'>OK!</a>
                            </p>
                        ");
                        //Redirect::to('/');
                        echo "success:;";
                    }
                }catch(Exception $e){
                    die($e->getMessage());
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
        //}
    }   
   