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

   
<header>
    <nav class= "navbar">
        <form action="index.php" method="post" >
            <ul class="navul">

                    <?php
                // balise php avec la condition de reconnaisance du profil user
                    // echo('<li class="navli"><a href="index.php">Home</a></li>');
                    // echo ('<li class="navli"><a href="users">Connexion</a></li>');
                    // echo ('<li class="navli"><a href="users">Inscription</a></li>');
                    // var_dump($categories);
                    // foreach ($categories as $categorie)  
                    
                    // {
                    //     echo ('<li class="navli"><a href="'. url.'products/'.$categorie[0]['name'].'">'.$categorie['name'].'</a></li>');
                    // }
              
                    echo('<li class="navli"><a href="index">Home</a></li>');
                    echo ('<li class="navli"><a href="login">Connexion</a></li>');
                    echo ('<li class="navli"><a href="register">Inscription</a></li>');
                    foreach ($categories as $categorie)  
                    {
                        echo ('<li class="navli"><a href="'.url.'products/'.$categorie['name'].'">'.$categorie['name'].'</a></li>');
                    }
                
                ?>
            </ul>
        </form>
    </nav>
</header>
<body>
    <?php

    if ( isset ($_SESSION['user_data'] ) )
    {
    ?>
        <nav>
            <ul>
                <li><a href="<?= urlmac ?>products">Nos produits</a></li>
                <li><a href="<?= urlmac ?>users/profil">Profil</a></li>
                <li><a href="<?= urlmac ?>users/disconnect">Deconnexion</a></li>
            </ul>
        </nav>
    <?php
    } else {
    ?>
        <nav>
            <ul>
                <li><a href="<?= urlmac ?>users/register">Inscription</a></li>
                <li><a href="<?= urlmac ?>users/login">Connexion</a></li>
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