document.addEventListener('DOMContentLoaded', function loaded() {
        //pour le pop up à l'accueil
        var close = document.getElementById('close');

        window.addEventListener('load', function(){
            // console.log('hey')
            setTimeout(
                function(){
                    document.querySelector('.pop-up').style.display = 'block';
                },
                900
            )
        });
            close.addEventListener("click", function(){
                document.querySelector('.pop-up').style.display = 'none';
            });


        //NAV BURGER
    
        var buttonBurger = document.querySelectorAll("div[class^='btn-']");
        //me retourne un array de tous les objets avec cette classe qui commence par "btn-" alors je saisis celui qui m'intéresse ici :

        console.log(buttonBurger);
        var buttonNav = buttonBurger[1];
        var buttonSearch = buttonBurger[0];

        
        var nav = document.querySelector('nav');
        var form = document.querySelector('form');
        console.log(nav)
        
        var images = document.querySelectorAll('img');
        var image = images[3];
        var img = images[0];
        // console.log(images);

        var buttonForm = document.getElementById("searchbutton");

        //BOUTONS LAYOUT MOBILE
    buttonNav.addEventListener("click", function(){
        //après avoir récupéré l'image qui m'intéresse plus haut, je lui dis que si je clique dessus, l'image change sinon ça revient à son image initiale
        //en plus de rajouter avec le toggle(propriété qui rajoute et retire) une classe css .open située à ma nav -> c'est cette classe qui a le transform 0% et donc permet de voir le menu
        if (image.src.match("images/utilitaires/menu.svg")) {
            image.src = "images/utilitaires/cross.svg";
        }
        else {
            image.src = "images/utilitaires/menu.svg";
        }
        nav.classList.toggle("openNav");

    });

    buttonSearch.addEventListener("click", function(){
        if (img.src.match("images/utilitaires/search.svg")) {
            img.src = "images/utilitaires/cross2.svg";
        }
        else {
            img.src = "images/utilitaires/search.svg";
        }
        form.classList.toggle("open");

    });



buttonNav.addEventListener("click", function(){
    //après avoir récupéré l'image qui m'intéresse plus haut, je lui dis que si je clique dessus, l'image change sinon ça revient à son image initiale
    //en plus de rajouter avec le toggle(propriété qui rajoute et retire) une classe css .open située à ma nav -> c'est cette classe qui a le transform 0% et donc permet de voir le menu
    if (image.src.match("images/utilitaires/menu.svg")) {
        image.src = "images/utilitaires/cross.svg";
    }
    else {
        image.src = "images/utilitaires/menu.svg";
    }
    nav.classList.toggle("open");
    // console.log(image);
}); 


});
