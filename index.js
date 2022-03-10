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
// console.log(nav);

var images = document.querySelectorAll('img');
var image = images[2];



buttonNav.addEventListener("click", function(){
    //après avoir récupéré l'image qui m'intéresse plus haut, je lui dis que si je clique dessus, l'image change sinon ça revient à son image initiale
    //en plus de rajouter avec le toggle(propriété qui rajoute et retire) une classe css .open située à ma nav -> c'est cette classe qui a le transform 0% et donc permet de voir le menu
    if (image.src.match("Images/utilitaires/menu.svg")) {
        image.src = "Images/utilitaires/cross.svg";
    }
    else {
        image.src = "Images/utilitaires/menu.svg";
    }
    nav.classList.toggle("open");
    // console.log(image);
});