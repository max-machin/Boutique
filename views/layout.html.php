<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boutique</title>
</head>
<body>
    <?php

    if ( isset ($_SESSION['user_data'] ) )
    {
    ?>
        <nav>
            <ul>
                <li><a href="register">Inscription</a></li>
                <li><a href="login">Connexion</a></li>
                <li><a href="profil">Profil</a></li>
                <li><a href="disconnect">Deconnexion</a></li>
            </ul>
        </nav>
    <?php
    } else {
    ?>
        <nav>
            <ul>
                <li><a href="register">Inscription</a></li>
                <li><a href="login">Connexion</a></li>
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