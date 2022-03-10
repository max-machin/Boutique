<?php
    if( isset ($_SESSION['user_data']) )
    {
?>
    <form method="post" action="">
        <div id="errors"></div>
        <input type="text" id="cardholder-name" placeholder="Titulaire de la carte">
        <div id="card-elements"></div>
        <div id="card-errors" role="alert"></div>
        <button id="card-button" type="button" data-secret="<?= $intent["client_secret"]; ?>">Procédez au paiement</button>
    </form>
    <?php var_dump($_SESSION['user_data']['livraison']); var_dump($_POST['facturation'])  ?>
    <script src="https://js.stripe.com/v3/"></script>
    <script type="text/javascript" src="http://localhost/Boutique/views/users/js/script.js"></script>
<?php

    } else {
        header('location: login');
    }