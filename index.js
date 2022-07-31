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
    console.log(imgSearch)
    if (imgSearch.src.match("images/utilitaires/search.svg")) {
        imgSearch.src = "images/utilitaires/cross2.svg";
    }
    else {
        imgSearch.src = "images/utilitaires/search.svg";
    }
    form.classList.toggle("open");

});


//SEARCHBAR

var input = document.querySelector('input');
var ul1 = document.getElementsByClassName('resultats-list-one');
var ul2 = document.getElementsByClassName('resultats-list-two');
let resultsdiv = document.getElementsByClassName('resultats-container');

resultsdiv[0].style.display = "none"

input.addEventListener('keyup', function(){

    resultsdiv[0].style.display = "block"

    // pour supprimer la liste à chaque fois
    ul1[0].innerHTML = ""
    ul2[0].innerHTML = ""

    var value = input.value;
    value = value.toLowerCase()

    // console.log(value);

        fetch('search.php',{
        method: 'POST',
        body: value
    })
    .then ((response) => response.json())
    .then ((response) => {
        console.log(response);

        if(!(value.length == " ")){

            if (response.length == 0){
                const resultNone = document.createElement('li')
                resultNone.classList.add('result-item')
                resultNone.innerHTML = "No results found."
                ul1[0].appendChild(resultNone)   

            }
            else 
            {
                for(let i = 0; i < response.length; i++)
                { 
                    var letter = response[i].name[0];
                    letter = letter.toLowerCase();

                    let letterS = response[i].name 
                    letterS = letterS.toLowerCase();


                    if(letterS.startsWith(value) == true) 
                    {
                        var letters = response[i].name
                        const a = document.createElement('a')
                        const resultItem = document.createElement('li')
                        resultItem.classList.add('result-item')
                        a.href = "products/"+ response[i].id
                        resultItem.innerHTML = letters
                        ul1[0].appendChild(a) 
                        a.appendChild(resultItem) 

                    }
                    else
                    {
                        const a = document.createElement('a')
                        const resultItems = document.createElement('li')
                        resultItems.classList.add('result-item')
                        a.href = "products/"+ response[i].id
                        resultItems.innerHTML = response[i].name
                        ul2[0].appendChild(a)
                        a.appendChild(resultItems) 
                    }
                }                       
            }
                          
        }
        else 
        {
            resultsdiv[0].style.display = "none"
        }

    })
    .catch((error) => console.log(error)) 

    
})



})

