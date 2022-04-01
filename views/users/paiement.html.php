<?php
    if( isset ($_SESSION['user_data']) )
    {

?>
<h1 class="txt-center">Paiement</h1>
    <section class="paiement">
        
        <form method="post" action="">
            <h2 class="sous-titre">Informations</h2>
                <div id="errors"></div>
                <div class="row">
                    <span>
                        <input class="basic-slide" id="cardholder-name" type="text" placeholder="Titulaire de la carte *" required/><label for="cardholder-name"><i class="fa-solid fa-user"></i></label>
                    </span>
                </div>
                <div class="card">
                    <div id="card-elements"></div>
                    <div id="card-errors" role="alert"></div>
                </div>
            
            <button class="submit" id="card-button" type="button" data-secret="<?= $intent["client_secret"]; ?>">Payer</button>
        </form>
        <img src="images/generalvibe/paiement2.jpg" alt="">
    </section>
    
    <script src="https://js.stripe.com/v3/"></script>
    <script type="text/javascript" src="http://localhost/Boutique/views/users/js/script.js"></script>
<?php

    } else {
        header('location: login');
    }