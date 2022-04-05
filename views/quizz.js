document.addEventListener('DOMContentLoaded', function loaded() {

// window.addEventListener("load", function() {
//     alert('hey');
// })



var submitAnswers = document.getElementById('submit');

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
                console.log(response)
              })
            .catch((error) => console.log(error)) 

    } 
    else if(score <= 30) 
    {
        fetch('models/dry.php')
        .then ((response) => response.json())
        .then((response) => {
            console.log(response)
          })
        .catch((error) => console.log(error)) 
    } 
    else 
    {
        fetch('models/normal.php')
        .then ((response) => response.json())
        .then((response) => {
            console.log(response)
          })
        .catch((error) => console.log(error)) 
    }

    fetch('models/test.php', {
    method: 'POST',
    body: JSON.stringify({scoreFinal: score})
    })
    .then ((response) => response.json())
    .then(data => {
        console.log(data.name)
      })
    .catch((error) => console.log(error)) 
})

})

