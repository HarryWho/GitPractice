<?php

if(!$page->second()){
?>
    <div class="grid-container">
        <div class="section">
            <div class="title">
                User Management
            </div>
            <div class="content">
                <a href="/administrator/users">Edit</a>
            </div>
        </div>
        <div class="section">
            <div class="title">
                Menu Management
            </div>
            <div class="content">
                Grid 2
            </div>
        </div>
        <div class="section">
            <div class="title">
                Article Management
            </div>
            <div class="content">
                Grid 3
            </div>
        </div>
        <div class="section">
            <div class="title">
                Settings Management
            </div>
            <div class="content">
                Grid 4
                
            </div>
        </div>
    </div>
<?php } else { 

        //echo ucfirst($page->second());
        switch($page->second()){
            case "users":
                // 
                include_once "phpModules/includes/manage_users.php";
            break;
            case "menus":

            break;
            case "pages":

            break;
            case "settings":

            break;
            case 'work':
                include_once "phpModules/includes/manage_work.php";
            break;
        }
        
 } ?>