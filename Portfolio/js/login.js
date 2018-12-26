function loginUser(){
    var username=document.getElementById('username');
    
    var password=document.getElementById('password');
    
    var token =document.getElementById('token');

    document.getElementById('usernameError').innerHTML='';
   
    document.getElementById('passwordError').innerHTML='';
    
   
    if (window.XMLHttpRequest) {
        // code for modern browsers
        xmlhttp = new XMLHttpRequest();
     } else {
        // code for old IE browsers
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        
        if (this.readyState == 4 && this.status == 200) {
        
            
            arr = this.responseText.split(';');
            
            var splitStr = arr[0].split(':');
           
            if(splitStr[0]==='success'){
                window.location ='/'
            }
            for(var i = 0; i < (arr.length); i++)
            {
                splitStr= arr[i].split(":");
                document.getElementById(splitStr[0]).innerHTML=splitStr[1];
            }
        }
      };
    xmlhttp.open("POST", "login.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("username="+username.value+"&password="+password.value+"&token="+token.value);
} 
