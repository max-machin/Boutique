<div class="pop-up">
    <button id="close" type="submit" name="submit-subscription"><img src="images/utilitaires/cross.svg" width="30px"></button>
    <h1 class="txt-center">Contest</h1>
    
    <article class="flex mobilepopup">
        <div> 
            <h3>Prizes : </h3>
            <p><i>Skincare kit</i></p>
            <a href="concours"><button class="submit">PARTICIPATE</button></a>
            <p class="help">(79€ of products)</p>    
        </div>
        
        <img src="images/generalvibe/conourskit2.jpg" alt="Winner price" >
    </article>


    <article class="desktopAccueil">
        <div>
            <h2>Take your chance!</h2>
                <p>Try to win : <i>Skincare kit </i></p>
                <a href="concours"><button class="submit">I WANT IT</button></a>
            <p class="help">Total price : 79€</p>
        </div>
        <img src="images/generalvibe/conourskit.jpg" alt="Winner price" height="350px">
    </article>
    
    <article class="txt-center">
        <p>Scan the QR CODE below and complete the form</p>
        <img src="images/utilitaires/Unitag_QRCode_1647709869412.png" alt="QR code">
    </article>
</div>


<article>
    <section class="images-accueil">
        <div id="accueil-img">
            <img class="img-accueil" src="images/generalvibe/imgvibe2.jpeg" alt="Fashion girls in bath">
            <img class="img-accueil" src="images/generalvibe/skincare.jpeg" alt="Photo of products">            
        </div>


        <div id="accueil-text">
            <h1>Embrace your skin</h1>
            <p>Channel a new type of glow, one that will never fade out with our newest products.
                Join Everglow.
            </p>
            <button>Join the movement</button>
        </div>
         
    </section>
   
    <section class="accueil-bestsellers">
        <hr> 
        <h2>Our Bestsellers</h2>

        <div class='wrapper'>
        <?php
            foreach($bestsellers as $bestseller)
            {
                ?>
                <div class='bestsellers-products'>
                    <div class="bestsellers-img">
                      <img src='uploads/<?= $bestseller['url_image'] ?>' alt="best-sellers product"/>  
                    </div>
                    <div class='intern-case'>
                        <h3><a href='products/<?= $bestseller['id'] ?>'><?= $bestseller['name'] ?></a></h3>
                        <button><p id=''>Add  -  $<?= $bestseller['price'] ?></p></button>                         
                    </div>
                       
                </div> 
                <?php
            }
        ?>
        </div>
    </section>
    <section class="accueil-banderole">
        <hr>
        <div class="banderole">
            <img src="images/generalvibe/imgvibe3.jpeg" width="400px" alt="girls with skincare">
            <div class="text-banderole">
                <p class="accroche-banderole">Shipping is free from 50 dollars and above!</p>
                <p class="p-banderole">So what are you waiting for?</p>
            </div>
            <img src="images/generalvibe/vibe.jpeg" width="400px" alt="products">
        </div>
    </section>
    <section class="accueil-instagram">
        <hr>
        <div class='titre-instagram'><h2>Instagram with you</h2> <img src="images/utilitaires/like.png" alt="like icone"></div>
        
        <div class="insta">
            <div class="instafeed"></div>
        </div>
    </section>

    <section class="cardsAbout">
        <div class="cardAbout">
            <img src="images/utilitaires/leaf (1).png" height="100px" alt="leaf">
            <p>100% natural products</p>
        </div>
        <div class="cardAbout">
            <img src="images/utilitaires/clock.png" height="100px" alt="fast delivery chrono">
            <p>Delivery within 24h</p>
        </div>
        <div class="cardAbout">
            <img src="images/utilitaires/delivery.png" height="100px" alt="fast truck ">
            <p>Free delivery for commands over 50€</p>
        </div>
        <div class="cardAbout">
            <img src="images/utilitaires/security.png" height="100px" alt="secured payments">
            <p>Secured payements</p>
        </div>
        
    </section>
</article>



<?php

