// window.addEventListener('load', function(){
//     alert('hey');
// }
// );



//NAV BURGER

var buttonBurger = document.getElementsByClassName("btn-navigation");
//me retourne un array de tous les objets avec cette classe alors je saisis celui qui m'intéresse ici :
var buttonNav = buttonBurger[0];
// console.log(buttonNav);

var nav = document.querySelector('nav');
console.log(nav);

var images = document.querySelectorAll('img');
var image = images[2];

console.log(image);

buttonNav.addEventListener("click", function(){
    nav.classList.toggle("open");
});