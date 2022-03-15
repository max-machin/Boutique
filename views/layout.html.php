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
    // var_dump($_GET);
    if ( isset ($_SESSION['user_data'] ) )
    {
    ?>
        <nav>
            <ul>
                <li><a href="<?= urlmac ?>products">Nos produits</a></li>
                <li><a href="<?= urlmac ?>users/profil">Profil</a></li>
                <li><a href="<?= urlmac ?>users/disconnect">Deconnexion</a></li>
                <?php
                foreach ($categories as $categorie)  
                    {
                        echo ('<li class="navli"><a href="'.urlmac.'products/'.$categorie['name'].'">'.$categorie['name'].'</a></li>');
                    }
                ?>
            </ul>
        </nav>
    <?php
    } else {
    ?>
        <nav>
            <ul>
                <li><a href="<?= urlmac ?>users/register">Inscription</a></li>
                <li><a href="<?= urlmac ?>users/login">Connexion</a></li>
                <?php
                foreach ($categories as $categorie)  
                    {
                        echo ('<li class="navli"><a href="'.urlmac.'products/'.$categorie['name'].'">'.$categorie['name'].'</a></li>');
                    }
                ?>
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