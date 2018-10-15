<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Side Menu</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav class="navbar">
        <span class="open-slide" id="open-slide">
            <a href="#" onclick="chooseDirection()">
                <svg width="30" height="30" >
                    <path d="M0,5,30,5" stroke="#fff" stroke-width="5"/>
                    <path d="M0,14,30,14" stroke="#fff" stroke-width="5"/>
                    <path d="M0,23,30,23" stroke="#fff" stroke-width="5"/>
                </svg>
            </a>
        </span>
        <div class="brand">
            <h1>My Site</h1>
        </div>
        <ul class="navbar-nav">
            <li><a href="#"><i class="far fa-comment-alt"></i></a></li>
            <li><a href="#"><i class="far fa-envelope"></i></a></li>
            <li><a href="#"><i class="fas fa-user"></i></a></li>
            <li><a href="#"><i class="fas fa-cogs"></i></a></li>
        </ul>
    </nav>
    <div id="side-menu" class="side-nav">
        <div class="opened-menu" id="opened-menu">
            <!-- <a href="#" class="btn-close" id="btn-close" onclick="closeSlideMenu()">&times;</a> -->
            <a href="#">Home</a>
            <a href="#">About</a>
            <a href="#">Services</a>
            <a href="#">Contact</a>
        </div>
        <div class="closed-menu" id="closed-menu">
            <a href="#"><i class="fas fa-home"></i></a>
            <a href="#"><i class="fas fa-info-circle"></i></a>
            <a href="#"><i class="fas fa-concierge-bell"></i></a>
            <a href="#"><i class="fas fa-envelope"></i></a>
        </div>

    </div>
    <div id="main">
        <h1>Responsive side menu</h1>
    </div>

    <script>
        function openSlideMenu(){
            document.getElementById('closed-menu').style.visibility ='hidden';
            document.getElementById('opened-menu').style.visibility ='visible';
            document.getElementById('side-menu').style.width ='250px';
            document.getElementById('main').style.marginLeft ='280px';
            // document.getElementById('open-slide').style.visibility ='hidden';
            
            
            
            // document.getElementById('btn-close').innerHTML = "<<";
        }
        function closeSlideMenu(){
            document.getElementById('opened-menu').style.visibility ='hidden';
            document.getElementById('closed-menu').style.visibility ='visible';
            document.getElementById('side-menu').style.width ='50px';
            document.getElementById('main').style.marginLeft ='80px';
            // document.getElementById('open-slide').style.visibility='visible';
            
           

        }
        function chooseDirection(){
            var sideMenu=document.getElementById('side-menu');

            
            if(sideMenu.style.width =='50px'){
                openSlideMenu();
            }else{
                closeSlideMenu();
            }
            
        }
    </script>
</body>
</html>