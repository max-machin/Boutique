<?php
    if( isset ($_SESSION['user_data']) )
    {

?>
    <form class="form" method="post" action="">
        <div id="errors"></div>
        <div class="form-group">
            <input type="text" id="cardholder-name" required>
            <label for="cardholder-name">Titulaire de la carte *</label>
        </div>
        <div id="card-elements"></div>
        <div id="card-errors" role="alert"></div>
        <button class="submit" id="card-button" type="button" data-secret="<?= $intent["client_secret"]; ?>">Procédez au paiement</button>
    </form>
    <script src="https://js.stripe.com/v3/"></script>
    <script type="text/javascript" src="http://localhost/Boutique/views/users/js/script.js"></script>
<?php

    } else {
        header('location: login');
    }