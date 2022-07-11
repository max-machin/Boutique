document.addEventListener('DOMContentLoaded', function loaded() {
           
//NAV BURGER

    var buttonBurger = document.querySelectorAll("div[class^='btn-']");
    //me retourne un array de tous les objets avec cette classe qui commence par "btn-" alors je saisis celui qui m'intéresse ici :

    console.log(buttonBurger);
    var buttonSearch = buttonBurger[0];
    var buttonNav = buttonBurger[1];

    
    var nav = document.querySelector('nav');
    var form = document.querySelector('form');
    console.log(nav)
    
    var imageNav = document.getElementById("menu");
    var imgSearch = document.getElementById("search");

    var buttonForm = document.getElementById("searchbutton");

    //BOUTONS LAYOUT MOBILE
buttonNav.addEventListener("click", function(){
    //après avoir récupéré l'image qui m'intéresse plus haut, je lui dis que si je clique dessus, l'image change sinon ça revient à son image initiale
    //en plus de rajouter avec le toggle(propriété qui rajoute et retire) une classe css .open située à ma nav -> c'est cette classe qui a le transform 0% et donc permet de voir le menu
    if (imageNav.src.match("images/utilitaires/menu.svg")) {
        imageNav.src = "images/utilitaires/cross.svg";
    }
    else {
        imageNav.src = "images/utilitaires/menu.svg";
    }
    nav.classList.toggle("openNav");

});

buttonSearch.addEventListener("click", function(){
    if (imgSearch.src.match("images/utilitaires/search.svg")) {
        imgSearch.src = "images/utilitaires/cross2.svg";
    }
    else {
        imgSearch.src = "images/utilitaires/search.svg";
    }
    form.classList.toggle("open");

});


})

