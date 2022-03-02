<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/81dc42ea59.js" crossorigin="anonymous"></script>
    <link href="image/fontawesome-free-5.15.4-web.zip/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
    <title>Boutique</title>
</head>
<body>
    <?php

    if ( isset ($_SESSION['user_data'] ) )
    {
    ?>
        <nav>
            <ul>
                <li><a href="<?= url ?>products">Nos produits</a></li>
                <li><a href="<?= url ?>users/profil">Profil</a></li>
                <li><a href="<?= url ?>users/disconnect">Deconnexion</a></li>
            </ul>
        </nav>
    <?php
    } else {
    ?>
        <nav>
            <ul>
                <li><a href="<?= url ?>users/register">Inscription</a></li>
                <li><a href="<?= url ?>users/login">Connexion</a></li>
            </ul>
        </nav>
    <?php
    }

    ?>

<div class="container">
    <?= $content ?>
</div>



</body>
</html>