function openSlideMenu(){
    document.getElementById('closed-menu').style.visibility ='visible';
    document.getElementById('opened-menu').style.visibility ='visible';
    document.getElementById('side-menu').style.width ='250px';
    document.getElementById('main').style.marginLeft ='280px';
    // document.getElementById('open-slide').style.visibility ='hidden';
    
    
    
    // document.getElementById('btn-close').innerHTML = "<<";
}
function closeSlideMenu(){
    document.getElementById('opened-menu').style.visibility ='hidden';
    document.getElementById('closed-menu').style.visibility ='visible';
    document.getElementById('side-menu').style.width ='55px';
    document.getElementById('main').style.marginLeft ='80px';
    // document.getElementById('open-slide').style.visibility='visible';
    
   

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