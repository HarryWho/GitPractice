<?php
        require_once 'phpModules/core/init.php';
        
    if(Input::exists()){
        // if(Token::check(Input::get('token'))){
        //    echo Input::get('token')." --- ". Session::get('token');
       // echo full_url( $_SERVER ) ;
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
                echo $salt = Hash::salt(32);
                //exit;
                try{
                    $user->create(array(
                        'userName' => '',
                        'userEmail' => '',
                        'userPassword' => '',
                        'userSalt' => '',
                        'userJoined' => '',
                        'userGroup' => '',


                    ));
                }catch(Exception $e){
                    die($e->getMessage());
                }
            //     if(Session::exists('user')){
            //         Session::delete('user');
            //         Session::put('user',Input::get('username'));
            //     }
                
            //     Session::flash('success',
            //         "<p>Thank you " .Input::get('username') ." </p><p>You have successfully registered</p>
            //         <p>
            //         <br />
            //             We have sent an email to the following address
            //         </p>
            //         <p>
            //         <br />".
            //               Input::get('email')
            //         ."</p>
            //         <p>
            //         <br />
            //             Please follow the link sent in the email top validate you subscription
            //         </p>
            //         <p>
            //         <br />
            //             <a href='#close' class='btn btn-md btn-success'>OK!</a>
            //         </p>
            //     ");
               
               
            // //     header('Location: index.php#registerSuccessModal');
            // //    return false;
            //     echo "session:;";
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
   