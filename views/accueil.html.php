
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