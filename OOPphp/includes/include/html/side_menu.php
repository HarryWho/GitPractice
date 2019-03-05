<div class="side-menu">
    <div class="uid">
        <div>   
            
            <div class="w3-bar w3-black">
                <a href="#" title="View Calendar"><i class="fas fa-calendar-alt"></i></a>
            </div>
            <?php if(Session::exists(Config::get('session/session_name'))) { ?>
                <div class="w3-bar w3-black">
                    <a title="Logout" href="#"><i class="fas fa-sign-out-alt"></i></a>
                </div>
            <?php } ?>
            
        </div>
    </div>  
   
        <div class="calendar-container">
            <?php 
                if($user->isLoggedIn()){
                    $calendar = new Calendar($month,$year);
                    echo $calendar->show();

                ?>
                <div class="icons">
                    <div><a href="/?p=<?php echo md5('add'); ?>&month=<?php echo $month; ?>&year=<?php echo $year; ?>"><i class="fas fa-pen-nib"></i></a></div>
                    <div><a href="/?p=<?php echo $_GET['p'] ?>"><i class="fas fa-calendar-day"></i></a></div>
                    
                </div>
                <div class="blog-links">
                    <a href="#">A Link</a>
                </div>
            <?php } ?>
        </div>
   
</div>
