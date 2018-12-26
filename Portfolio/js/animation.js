function openSlideMenu(){
    document.getElementById('closed-menu').style.visibility ='visible';
    document.getElementById('opened-menu').style.visibility ='visible';
    document.getElementById('side-menu').style.width ='250px';
    document.getElementById('side-menu').style.backgroundColor ='#3b5998';

    document.getElementById('main').style.marginLeft ='280px';
    document.getElementById('searchBtn').style.marginRight ='-10px';
    document.getElementById('search').style.visibility='visible';
}
function closeSlideMenu(){
    document.getElementById('opened-menu').style.visibility ='hidden';
    document.getElementById('closed-menu').style.visibility ='visible';
    document.getElementById('side-menu').style.width ='55px';
    document.getElementById('main').style.marginLeft ='80px';
    document.getElementById('searchBtn').style.marginRight ='-3px';
    document.getElementById('search').style.visibility='hidden';
    
   
}
function chooseDirection(){
    var sideMenu=document.getElementById('side-menu');

    // alert(sideMenu.style.width);
    if(sideMenu.style.width ==='55px'||sideMenu.style.width===' '||sideMenu.style.width===null){
        openSlideMenu();
    }else{
        closeSlideMenu();
    }
    
}