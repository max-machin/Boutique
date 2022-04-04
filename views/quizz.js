document.addEventListener('DOMContentLoaded', function loaded() {

// window.addEventListener("load", function() {
//     alert('hey');
// })

var score = 0

var submitAnswers = document.getElementById('submit');


submitAnswers.addEventListener("click", function(){
    var q1 = document.querySelector('input[name="q1"]:checked').value; 
    var q2 = document.querySelector('input[name="q2"]:checked').value;
    var q3 = document.querySelector('input[name="q3"]:checked').value;
    
    if(q1 === "oily"){
        var score = 1;
    } else if (q1 === "dry") {
        var score = 20;
    } else if (q1 === "normal") {
        var score = 30;
    } else {
        var score = 4;
    }

    if(q2 === "acne"){
        var score = score + 1;
    } else if (q2 === "red") {
        var score = score + 4;
    } else if (q3 === "wrinkle") {
        var score = score + 5;
    } else {
        var score = score + 2;
    }

    if(q3 === "dry"){
        var score = score + 2
    } else if (q3 === "oily"){
        var score = score + 1
    } else {
        var score = score + 0
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

