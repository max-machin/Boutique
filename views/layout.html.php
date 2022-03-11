<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <BASE href="http://localhost:8080/Boutique/">
    <link rel="stylesheet" href="style.css">
    <script src="index.js" charset="utf-8"></script>
    <script src="https://kit.fontawesome.com/81dc42ea59.js" crossorigin="anonymous"></script>
    <link href="image/fontawesome-free-5.15.4-web.zip/css/all.css" rel="stylesheet">
    <title>Everglow | Clean Skincare & Beauty products </title>
</head>

<body>
    <header>
        <div class="container_promo">
            <p>15% de réduction en profitant du code : <?= codePromo ?></p>
        </div>
        <div class="top-header">
            <div class="top-before-animation">
                <div class="btn-search">
                    <img src="images/utilitaires/search.svg" width="40px">
                </div>             

                <a href="accueil"><img src="images/utilitaires/Everglow.png" width="120px"></a>
    
    
                <div class="btn-navigation">
                    <img src="images/utilitaires/menu.svg" width="40px">
                </div>
            </div>

            <form action="" method="post">
                <div class="intern-form">
                    <input type="text" name="search" placeholder="Search">
                    <button id="searchbutton" type="submit" name="submit-search"><img src="images/utilitaires/search.svg" width="35px"></button>                    
                </div>

            </form>   
      <?php
        if ( isset ($_SESSION['user_data'] ) )
        {
        ?>
            <nav>
                <ul>
                    <li><a href="users/profil"><img src="images/utilitaires/user.svg" width="40px"></a></li>
                    <li><a href="bags"><img src="images/utilitaires/bag.svg" width="40px"></a></li>                    
                    <li><a href="users/disconnect"><img src="images/utilitaires/power.svg" width="43px"></a></li>
                </ul>
            </nav>
        <?php
        } else {
        ?>
            <nav>
                <ul>
                    <li><a href="users/register"><img src="images/utilitaires/register.svg" width="45px"></a></li>
                    <li><a href="users/login"><img src="images/utilitaires/power.svg" width="45px"></a></li>
                </ul>
            </nav>
        <?php
        }
        ?>           
        </div>

        <div class="bottom-header">
        <nav class="categories">
            <ul>
                <li><a href="<?= urlLaura ?>">All our products</a></li>
                <li><a href="<?= urlLaura ?>">Skincare</a></li>
                <li><a href="<?= urlLaura ?>">Make up</a></li>
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

    
</body>
</html>