<div class="pop-up">
    <button id="close" type="submit" name="submit-subscription"><img src="images/utilitaires/cross.svg" width="30px"></button>

    <img src="images/generalvibe/general.jpeg" width="250px">

    <h2>Why not sign up to our newsletter?</h2>
    
    <p>In order to get exclusive offers and news, even events created by your favorite online shop, leave us your mail and find us there!</p>

    <form action="" method="post">
        <input type="text" name="subscribe" placeholder="Subscribe">
        <button id="subscribe-noir" type="submit" name="submit-subscription"><img src="images/utilitaires/flechedroite.svg" width="10px"></button>                    
    </form>  
</div>


<article>
    <section class="images-accueil">
        <img class="img-accueil" src="images/generalvibe/imgvibe2.jpeg">
        <img class="img-accueil" src="images/generalvibe/skincare.jpeg">

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
                    <img src='uploads/<?= $bestseller['url_image'] ?>'/>
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
    <section class="accueil-instagram">
        <hr>
        <div class='titre-instagram'><h2>Instagram with you</h2> <img src="images/utilitaires/like.png"></div>
        
    </section>
</article>