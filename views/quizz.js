document.addEventListener('DOMContentLoaded', function loaded() {

var submitAnswers = document.getElementById('submit');

var divS = document.getElementsByClassName('suggestedProducts')
var divSuggested = divS[0]

submitAnswers.addEventListener("click", function(event){

    var score = 0
    //permet de prevent le bouton à ce qu'il se refresh pour me permettre de debug
    event.preventDefault();

    var q1 = document.querySelector('input[name="q1"]:checked').value; 
    var q2 = document.querySelector('input[name="q2"]:checked').value;
    var q3 = document.querySelector('input[name="q3"]:checked').value;
    
    if(q1 === "oily"){
        score = 1;
    } else if (q1 === "dry") {
        score = 20;
    } else if (q1 === "normal") {
        score = 30;
    } else {
        score = 4;
    }

    if(q2 === "acne"){
        score = score + 1;
    } else if (q2 === "red") {
        score = score + 4;
    } else if (q3 === "wrinkle") {
        score = score + 5;
    } else {
        score = score + 2;
    }

    if(q3 === "dry"){
        score = score + 2
    } else if (q3 === "oily"){
        score = score + 1
    } else {
        score = score + 0
    }

    if(score <= 20) 
    {
        fetch('models/oily.php')
            .then ((response) => response.json())
            .then((response) => {
                response.forEach(element => {
                    console.log(element.name)
                    var productID = element.id
                    var productName = element.name
                    const h2 = document.createElement("h2")
                    h2.className = "h2product"
                    h2.innerHTML = productName
                    divSuggested.appendChild(h2)
                    h2.addEventListener('click', function() {
                        location.href = 'products/'.concat(productID)
                    }, false);
                    console.log(h2)
                });
              })
            .catch((error) => console.log(error)) 

    } 
    else if(score <= 30) 
    {
        fetch('models/dry.php')
        .then ((response) => response.json())
        .then((response) => {
            response.forEach(element => {
                console.log(element.name)
                var productID = element.id
                var productName = element.name
                var productPrice = element.price
                const h2 = document.createElement("h2")
                h2.className = "h2product"
                h2.innerHTML = productName
                divSuggested.appendChild(h2)
                h2.addEventListener('click', function() {
                    location.href = 'products/'.concat(productID)
                }, false);
                console.log(h2)
            });
          })
        .catch((error) => console.log(error)) 
    } 
    else 
    {
        fetch('models/normal.php')
        .then ((response) => response.json())
        .then((response) => {
                response.forEach(element => {
                console.log(element.name)
                var productID = element.id
                var productName = element.name
                var productPrice = element.price
                const h2 = document.createElement("h2")
                h2.className = "h2product"
                h2.innerHTML = productName
                divSuggested.appendChild(h2)
                h2.addEventListener('click', function() {
                    location.href = 'products/'.concat(productID)
                }, false);
                console.log(h2)
            });
          })
        .catch((error) => console.log(error)) 
    }

    })

})

