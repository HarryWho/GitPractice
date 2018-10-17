function registerUser(){
    var username=document.getElementById('regusername');
    var email=document.getElementById('email');
    var password=document.getElementById('regpassword');
    var repassword=document.getElementById('regrepassword');
    //alert(username.value+' '+email.value+' '+password.value+' '+repassword.value);
    if(!username.value){
        username.style.border='1px red solid';
        document.getElementById('usernameError').innerHTML="User name is Required";
        return;
    }else{
        username.style.border='0';
        document.getElementById('usernameError').innerHTML="";
    }
    
    if(!IsValidEmail(email.value)){
        
        email.style.border='1px red solid';
        document.getElementById('emailError').innerHTML="A Valid Email is Required";
        return;
    }else{
        
        email.style.border='';
        document.getElementById('emailError').innerHTML="";
    }
    if(password.value==""){
        password.style.border='1px red solid';
        document.getElementById('passwordError').innerHTML="Password field is Required";
        return;
    }else{
        
        password.style.border='';
        document.getElementById('passwordError').innerHTML="";
    }
    if(repassword.value!=password.value){
        repassword.style.border='1px red solid';
        document.getElementById('repasswordError').innerHTML="Passwords do not match";
        return;
    }else{
        
        repassword.style.border='';
        document.getElementById('repasswordError').innerHTML="";
    }
    if (window.XMLHttpRequest) {
        // code for modern browsers
        xmlhttp = new XMLHttpRequest();
     } else {
        // code for old IE browsers
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          //document.getElementById("registerModal").innerHTML = this.responseText;
          var splitStr= this.responseText.split(":");
          document.getElementById('title').innerHTML="<h2>"+splitStr[0]+"</h2>";
          document.getElementById('content').innerHTML=splitStr[1];
          
          document.location='#registerSuccessModal';

        }
      };
    
    xmlhttp.open("POST", "phpModules/ajax/register.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("username="+username.value+"&email="+email.value+"&password="+password.value);
}
function IsValidEmail(eAdd){
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(eAdd).toLowerCase());
}