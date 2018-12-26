<?php
include_once "phpModules/classes/Admin/Users.php";
$admin = new Users();
//echo "Before Loop";
if(!$path->path()[3]){
    $users = $admin->getusers();

    echo "<div class='list'>
            <table><caption><a href='/administrator/users/add'>Add User</a></caption>
                <tr>
                    <th>Name</th><th>Email</th><th>Date Joined</th><th>Permissions</th><th></th><th></th>
                </tr>
                ";
    foreach($users as $user){
        echo "<tr><td>{$user->userName}</td>
                <td>{$user->userEmail}</td>
                <td>{$user->userJoined}</td>
                <td>{$user->userGroup}</td>
                <td><a href='/administrator/users/edit/{$user->userId}'>Edit</a></td>
                <td><a href='/administrator/users/delete/{$user->userId}'>Delete</a></td>
            </tr>";
    }
    echo "</table>
    
    </div>";
}else{
    $type= $path->path()[3];
   $id=$path->path()[4];
    if($type==='edit'||$type==='add'){
        if(is_numeric($id)){
            $user=$admin->getUser($id);
            $uname=$user->first()->userName;
            $uemail=$user->first()->userEmail;
            $ugroup=$user->first()->userGroup;
            $which='update';
        }else{ 
            
                
                $uname=Input::get('userName');
                $uemail=Input::get('userEmail');
                $ugroup=Input::get('userGroup');
            
            $which='save'; }
        echo "<div class='form'>
                    <form action='/administrator/users/{$which}' method='POST'>
                    <input type='hidden' name='userId' value='" .$id ."'>
                    <div class='form-field'>
                        <label for='userName'>User Name</label>
                        <input type='text' name='userName' value='" .$uname."'>
                    </div>
                    <div class='form-field'>
                        <label for='userEmail'>User Email</label>
                        <input type='text' name='userEmail' value='" .$uemail."'>
                    </div>

                    <div class='form-field'>
                        <label for='userGroup'>User Permission</label>
                        
                        <input type='number' name='userGroup' min='0' max='4' value='{$ugroup}'>
                    </div>
                    <input type='submit' value='Update'>
                    </form>
                </div>";
    }else{
        switch($type){
            case "update":
                if(Input::exists()){
                    $fields = array(
                        'userName' => Input::get('userName'),
                        'userEmail' => Input::get('userEmail'),
                        'userGroup' => Input::get('userGroup')
                    );
                    if($admin->update('users',Input::get('userId'), $fields)){
                        Redirect::to('/administrator/users');

                    }else{
                        echo "Something went wrong!!!";
                    }
                }
            break;
            case "save":
                if(Input::exists()){
                    $msg='';
                    if(!Input::get('userName'))
                        $msg.="Username is a require field <br>";
                    if(!Input::get('userEmail'))
                        $msg.="Email is a required field<br>";
                    if(!Input::get('userGroup'))
                        $msg.="User Group is required<br>";
                    if($msg){
                        
                        Session::flash('home',$msg);
                        Redirect::to('/administrator/users/add');
                    }
                    $fields=array(
                        'userName' => Input::get('userName'),
                        'userEmail' => Input::get('userEmail'),
                        'userGroup' => Input::get('userGroup')
                    );
                    if($admin->addUser('users',$fields)){
                        Redirect::to('/administrator/users');
                    }else{
                        echo "Something went wrong!!!";
                    }
                }
            break;
            case "delete":
                if($admin->delete('users',array('userId', '=', $id))){
                    Redirect::to('/administrator/users');
                }else{
                    echo "Something went wrong!!";  
                }
            break;
        }
    }
    
}