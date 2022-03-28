// window.addEventListener('load', function(){
//     alert('hey');
// }
// );
document.addEventListener('DOMContentLoaded', function loaded() {

            //NAV BURGER
    
        var buttonBurger = document.querySelectorAll("div[class^='btn-']");
        //me retourne un array de tous les objets avec cette classe qui commence par "btn-" alors je saisis celui qui m'intéresse ici :

        console.log(buttonBurger);
        var buttonNav = buttonBurger[1];
        var buttonSearch = buttonBurger[0];
        
        var nav = document.querySelector('nav');
        var form = document.querySelector('form');
        
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
        nav.classList.toggle("open");
        // console.log(image);
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


    //pour le slider dans seeproduct

    let img_slider = document.getElementsByClassName('img_slider');
    
    function definirFirstImg (){
        img_slider[0].classList.add('active');
    }
    definirFirstImg();

    let etape = 0;

    let nb_img = img_slider.length;

    let precedent = document.querySelector('#previous');
    let suivant = document.querySelector('#next');

    function enleverActiveImages() {
        for(let i = 0; i < nb_img; i++){
            img_slider[i].classList.remove('active');
        }
    }

    suivant.addEventListener('click', function(){
        etape++;
        enleverActiveImages();
        // console.log(img_slider[etape]);
        img_slider[etape].classList.add('active');
    })

//pour le pop up à l'accueil
   var close = document.getElementById('close');

//    window.addEventListener('load', function(){
//     setTimeout(
//         function open(event){
//             document.querySelector('.pop-up').style.display = 'block';
//         },
//         900
//     )
//    });
//     close.addEventListener("click", function(){
//         document.querySelector('.pop-up').style.display = 'none';
//     });
});

