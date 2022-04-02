<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <BASE href="http://localhost/Boutique/"> -->
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
            <p>15% de réduction en profitant du code : <?= codePromo ?>          Livraison gratuite à partir de 50euros</p>
            <!-- voir comment rajouter un deuxième -->
        </div>
        <div class="top-header">           
            <form action="" method="post">
                <div class="intern-form">
                    <input type="text" name="search" placeholder="Search">
                    <button id="searchbutton" type="submit" name="submit-search"><img src="images/utilitaires/search.svg" width="35px"></button>                    
                </div>
            </form>  
            <div class="top-before-animation">
                <div class="btn-search">
                    <img src="images/utilitaires/search.svg" width="40px">
                </div>             

                <a href="accueil"><img src="images/utilitaires/Everglow.png" id='everglow' width="120px"></a>
    
    
                <div class="btn-navigation">
                    <img id='menu' src="images/utilitaires/menu.svg" width="40px">
                </div>
            </div>

 
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
                    <li><a href="<?= url ?>">Our products</a></li>
                    <li><a href="<?= url ?>">Skincare</a></li>
                    <li><a href="<?= url ?>">Make up</a></li>
                    <li><a href="<?= url ?>">Discover your skin</a></li>
                </ul>
            </nav>
        </div> 
    </header>

    <div class="flex-wrapper">            
        <main>
            <div class="container">
                <?= $content ?>
            </div>  
        </main>

        <footer>
            <div class="social-media">
                <p>@everglow.brand</p>
                <img src="images/utilitaires/instagram-brands.svg" width="15px" class="filter-white">
                <img src="images/utilitaires/twitter-brands.svg" width="15px" class="filter-white">
                <img src="images/utilitaires/facebook-brands.svg" width="15px" class="filter-white">
                <img src="images/utilitaires/tiktok-brands.svg" width="15px" class="filter-white">
            </div>
            <div class="footer-up">
                <div id="sign-up">
                <h3>Sign up to our newsletter</h3>
                <form action="" method="post">
                    <input type="text" name="subscribe" placeholder="Subscribe">
                    <button id="subscribe" type="submit" name="submit-subscription"><img src="images/utilitaires/flechedroite.svg" width="10px" class="filter-white"></button>                    
                </form>  
                </div> 

                <div id="contact-us">
                <h3>Contact us</h3>
                <p>email@email.com</p> 
                <p>telephone number</p>
                <p>Monday - Friday 9a - 5p EST</p>   
                </div>
            </div>
           
            <div class="bordure-horizontale"></div>
           
            <div id="footer-down">
                <h3>About us</h3>
                <h3>Customer service</h3>
                <h3>Help & FaQ</h3>
            </div>

        </footer>
    </div>
</body>
</html>