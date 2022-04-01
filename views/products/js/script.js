document.addEventListener('DOMContentLoaded', function loaded() {
    //pour le slider dans seeproduct

    let img_slider = document.getElementsByClassName('img_slider');
    console.log('hey')
    console.log(img_slider);
    
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
        if(etape >= nb_img){
            etape = 0;
        }
        enleverActiveImages();
        // console.log(img_slider[etape]);
        img_slider[etape].classList.add('active');
    });

    precedent.addEventListener('click', function(){
        etape--;

        if(etape < 0){
            etape = nb_img - 1;
        }

        enleverActiveImages();
        img_slider[etape].classList.add('active');
    });

});