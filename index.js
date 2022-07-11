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

//INSTAFEED

const accessToken = "IGQVJXZAzljNlV0OHVUNDRUZAkNaZA28tRE5Nc09WMGp2Q3V3ekRTRjV2empnZA1kwSDc0UUE1WWlMbnppYnF0elFRNWFSZAFVyeFZAiWkgxZAnNEdEFSM3VwWlA3VFdoQkNOc2hrVXFZAMnBlTW9Dci1ZARlhXTQZDZD";

const fields = "id,media_type,media_url,timestamp,permalink";

const accessUrl = `https://graph.instagram.com/me/media?fields=${fields}&access_token=${accessToken}`;

const section = document.getElementsByClassName("instafeed")
const instafeed = section[0];

const fetchPosts = async () => {

    try {

        const response = await fetch(accessUrl)
        const {data} = await response.json()

        data.forEach(post => {
            let a = document.createElement("a");
            a.href = post.permalink
            a.target = "_blank"
            a.rel = "noreferrer noopener"

            if(post.media_type === "VIDEO"){
                let video = document.createElement("video");
                video.src = post.media_url
                video.preload = true
                video.autoplay = true
                video.muted = true
                video.loop = true
                a.appendChild(video)
            } else {
                let img = document.createElement("img");
                img.src = post.media_url
                a.appendChild(img)
            }
            
            instafeed.appendChild(a)

        });

    } catch (error) {
        console.error(error);
    }
}

fetchPosts();
})

