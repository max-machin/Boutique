<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/81dc42ea59.js" crossorigin="anonymous"></script>
    <link href="image/fontawesome-free-5.15.4-web.zip/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="./style.css">
    <title>Everglow | Clean Skincare & Beauty products </title>
</head>

<body>
    <header>
        <div class="top-header">
            <div class="top-before-animation">
                <form action="" method="post">
                    <input type="text" name="search" placeholder="Search">
                    <button id="searchbutton" type="submit" name="submit-search"><img src="Images/utilitaires/search.svg" width="35px"></button>
                </form>                

                <img src="Images/utilitaires/Everglow.png" width="120px">

                <div class="btn-navigation">
                    <img src="Images/utilitaires/menu.svg" width="40px">
                </div>
            </div>
                 <?php
                if ( isset ($_SESSION['user_data'] ) )
                {
                ?>
                    <nav>
                        <ul>
                            <li><a href="<?= urlLaura ?>users/profil"><img src="Images/utilitaires/user.svg" width="40px"></a></li>
                            <li><a href="<?= urlLaura ?>users/disconnect"><img src="Images/utilitaires/power.svg" width="43px"></a></li>
                            <li><a href="<?= urlLaura ?>bags"><img src="Images/utilitaires/bag.svg" width="40px"></a></li>
                        </ul>
                    </nav>
                <?php
                } else {
                ?>
                    <nav>
                        <ul>
                            <li><a href="<?= urlLaura ?>users/register">Inscription</a></li>
                            <li><a href="<?= urlLaura ?>users/login">Connexion</a></li>
                        </ul>
                    </nav>
                <?php
                }
                ?>           
        </div>
        
        <div class="bottom-header">
            <nav class="categories">
                <ul>
                    <li><a href="<?= urlLaura ?>">Skincare</a></li>
                    <li><a href="<?= urlLaura ?>">Make up</a></li>
                </ul>
            </nav>
        </div> 
    </header>

    <main>
        <div class="container">
            <?= $content ?>
        </div>  
    </main>

    <footer>
        ici le footer
    </footer>

    <script src="index.js" charset="utf-8"></script>
</body>
</html>