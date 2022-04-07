<div class="pop-up">
    <button id="close" type="submit" name="submit-subscription"><img src="images/utilitaires/cross.svg" width="30px"></button>
    <h1 class="txt-center">Jeux concours</h1>
    
    <article class="flex mobilepopup">
        <div> 
            <h3>A gagner</h3>
            <p>Un <i>kit skincare</i></p>
            <a href="concours"><button class="submit">PARTICIPER</button></a>
            <p class="help">(valeur de 79€)</p>    
        </div>
        
        <img src="images/generalvibe/conourskit2.jpg" alt="" >
    </article>


    <article class="desktopAccueil">
        <div>
            <h2>Tentez votre chance!</h2>
                <p>Tentez de gagner un <i>kit skincare</i></p>
                <a href="concours"><button class="submit">JE TENTE MA CHANCE</button></a>
            <p class="help">Prix total du coffret skincare à gagner : 79€*</p>
        </div>
        <img src="images/generalvibe/conourskit.jpg" alt="" height="350px">
    </article>
    
    <article class="txt-center">
        <p>Scannez le QR CODE ci-dessous et remplissez le formulaire</p>
        <img src="images/utilitaires/Unitag_QRCode_1647709869412.png" alt="">
    </article>
</div>


<article>
    <section class="images-accueil">
        <div id="accueil-img">
            <img class="img-accueil" src="images/generalvibe/imgvibe2.jpeg">
            <img class="img-accueil" src="images/generalvibe/skincare.jpeg">            
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
                      <img src='uploads/<?= $bestseller['url_image'] ?>'/>  
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
            <img src="images/generalvibe/imgvibe3.jpeg" width="400px">
            <div class="text-banderole">
                <p class="accroche-banderole">Shipping is free from 50 dollars and above!</p>
                <p class="p-banderole">So what are you waiting for?</p>
            </div>
            <img src="images/generalvibe/vibe.jpeg" width="400px">
        </div>
    </section>
    <section class="accueil-instagram">
        <hr>
        <div class='titre-instagram'><h2>Instagram with you</h2> <img src="images/utilitaires/like.png"></div>
        
        <div class="insta">
            <div class="instafeed"></div>
        </div>
    </section>

    <section class="cardsAbout">
        <div class="cardAbout">
            <img src="images/utilitaires/leaf (1).png" height="100px" alt="">
            <p>Produits 100% naturels</p>
        </div>
        <div class="cardAbout">
            <img src="images/utilitaires/clock.png" height="100px" alt="">
            <p>Livraison en 24h</p>
        </div>
        <div class="cardAbout">
            <img src="images/utilitaires/delivery.png" height="100px" alt="">
            <p>Livraison offerte dès 50€</p>
        </div>
        <div class="cardAbout">
            <img src="images/utilitaires/security.png" height="100px" alt="">
            <p>Paiements sécurisés</p>
        </div>
        
    </section>
</article>



<?php

