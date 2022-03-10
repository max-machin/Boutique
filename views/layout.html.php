<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/81dc42ea59.js" crossorigin="anonymous"></script>
    <link href="image/fontawesome-free-5.15.4-web.zip/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= url ?>style.css">
    <title>Everglow | Clean Skincare & Beauty products </title>
</head>

<body>
    <header>
        <div class="container_promo">
            <p>15% de réduction en profitant du code : <?= codePromo ?></p>
        </div>
        <div class="top-header">
            <div class="top-before-animation">
                <form action="" method="post">
                    <input type="text" name="search" placeholder="Search">
                    <button id="searchbutton" type="submit" name="submit-search"><img src="<?= url ?>images/utilitaires/search.svg" width="35px"></button>
                </form>                

                <img src="<?= url ?>images/utilitaires/Everglow.png" width="120px">
    
    
                <div class="btn-navigation">
                <img src="<?= url ?>images/utilitaires/menu.svg" width="40px">
                </div>
            </div>
      <?php
        if ( isset ($_SESSION['user_data'] ) )
        {
        ?>
            <nav>
                <ul>
                    <li><a href="<?= url ?>users/profil"><img src="Images/utilitaires/user.svg" width="40px"></a></li>
                    <li><a href="<?= url ?>users/disconnect"><img src="Images/utilitaires/power.svg" width="43px"></a></li>
                    <li><a href="<?= url ?>bags"><img src="Images/utilitaires/bag.svg" width="40px"></a></li>
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
        </div>

        <div class="bottom-header">
        <nav class="categories">
            <ul>
                <li><a href="<?= url ?>">Skincare</a></li>
                <li><a href="<?= url ?>">Make up</a></li>
            </ul>
        </nav>
        </div> 
</header>


</header>
<body>
    

               
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