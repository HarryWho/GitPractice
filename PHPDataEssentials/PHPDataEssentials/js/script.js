var ham = document.querySelector(".hamburger");
var mobile =document.querySelector(".mobile-menu");
ham.addEventListener("click", function(){
    ham.classList.toggle("is-active");
    mobile.classList.toggle("is-active");
});