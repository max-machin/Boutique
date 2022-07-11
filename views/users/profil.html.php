<?php 

if ( empty ( $user)) {
    
    header('location: login');
} else {
?>
    <h1 class="txt-center titre-profil">Your profile</h1>
   
    <article class="articleProfil">
        <form class="form" action="" method="post">
            <h2 class="sous-titre">Personal information</h3>
            <div class="form-group">
                <input id="email" type="email" name="email" value="<?= $user['email'] ?>" required>
                <label for="email">E-mail * (billing)</label>
            </div>
            <div class="form-group">
                <input id="surname" type="text" name="surname" value="<?= $user['prenom'] ?>" required>
                <label for="surname">First Name *</label>
            </div>
            <div class="form-group">
                <input id="name" type="text" name="name" value="<?= $user['nom'] ?>" required>
                <label for="name">Last Name *</label>
            </div>
            <input class="submit submit-profil" type="submit" name="submit" value="Change infos">
        </form>
        
        <img src="images/generalvibe/general1.jpeg" alt="Manage your account">
        <form class="form" action="" method="post" style="display: <?= $display1 ?>">
        <h2 class="sous-titre">Password</h3>
            <?= $success ?>
            <div class="form-group">
                <input id="oldPassword" type="password" name="oldPassword" required>
                <label for="oldPassword">Last password *</label>
                <div class="error-msg"><?= $error_old_password ?></div>
            </div>
            <input class="submit submit-profil" type="submit" name="subPassword" value="Confirme password">
        </form>

        <form class="form" action="" method="post" style="display: <?= $display2 ?>">
        <h2 class="sous-titre">Password</h3>
            <div class="form-group">
                <input id="newPassword" type="password" name="newPassword" required>
                <label for="newPassword">New password *</label>
                <div class="error-msg"><?= $error_new_password ?></div>
            </div>
            <div class="form-group">
                <input id="validPassword" type="password" name="validPassword" required>
                <label for="validPassword">Validate password *</label>
                <div class="error-msg"><?= $error_validPassword ?></div>
            </div>
            <input class="submit submit-profil" type="submit" name="subNewPassword" value="change password">
        </form>
    
    </article>
    <hr>
    <h2 class="sous-titre txt-center">Your last commands</h2>

<?php 

    

    foreach ($userCommands as $userCommand)
    {
        // Numéro de commandes
        $numCommands = explode(",", $userCommand['id_command']);

        // Nom des produits
        $names = explode(",",$userCommand['product_name']);


        $colors = explode(",",$userCommand['product_color']);

        // Quantité des produits
        $quantities = explode(",",$userCommand['quantity_product']);

        // Prix des produits
        $prices = explode(",",$userCommand['price']);
    
        // Prix total pour 1 produit = prix * quantité
        $total_prices = explode(",",$userCommand['total_price']);

        // Prix brut de la commande ( sans livraison / promos ) = somme des prix totaux 
        $commandPrice = array_sum($total_prices);

        // Promotion
        $promos = explode(",",$userCommand['promo']);

        // Calcul de la promo
        $calculPromo = intval($promos[0]) / 100;
        $promo = $commandPrice * $calculPromo;

        // Soustraction du la promo au prix de la commande
        $commandPricePromo = $commandPrice - $promo;
    
        // Date de commande
        $dates = explode(",",$userCommand['date']);

        // Adresse de livraison
        $livraisons = explode(",",$userCommand['adresse_livraison']);

        // Adresse de facturation
        $facturations = explode(",",$userCommand['adresse_facturation']);

        // Prix de la livraison
        $deliveryPrices = explode(",",$userCommand['price_livraison']);
        $deliveryPrice = array_unique($deliveryPrices);

        // Mode de livraison
        $deliveryMode = explode(",",$userCommand['mode']);
        $mode = array_unique($deliveryMode);

        

        foreach (array_unique($numCommands) as $num)
        {
        ?>
        <fieldset>
            <article class="userCommand">
                <div class="inCommandUser">
                    <article>
                        <p>N° of command : <i class="bold"><?= $num ?></i></p>
            
            <?php
        }
                foreach(array_unique($promos) as $promo)
                {
                    if ( $deliveryPrice[0] === '')
                    {
                        $deliveryPrice[0] = 0;
                    }
                    $commandPrice = $commandPrice += $deliveryPrice[0];

                    if ( $promo === "")
                    {
                    
                        ?>
                        <p>Amount : <i class="bold"><?= $commandPrice ?>€</i></p>
                        <?php

                    } else {
                    $commandPricePromo = $commandPricePromo += $deliveryPrice[0];
                        ?>
                        <p>Amount: <i class="bold"><?= $commandPricePromo ?>€</i></p>
                        <?php
                    }
                }

                foreach (array_unique($dates) as $date)
                {   
                    ?>
                    <p>Date : <i class="bold"><?= $date ?></i></p>
                    
                    <?php
                }

                
                foreach ( array_unique($livraisons) as $livraison)
                {
                    ?>
                        <div>
                            <h3>Shipping</h3>
                            <p>Delivery address : <i class="bold"><?= $livraison ?></i></p>
                        </div>
                    <?php
                }


            
                foreach ( array_unique($facturations) as $facturation)
                {
                    ?>
                        <div>
                            <h3>Billing</h3>
                            <p>Billing address : <i class="bold"><?= $facturation ?></i></p>
                        </div>
                    <?php
                }
                
                ?>
                </article>
                <section class="containerCommandUser">
                    <article class="grid article-profil">
                        <div>
                            <h4>Products</h4> 
                            <?php
                                foreach($names as $name)
                                {
                                ?>
                                    <p><?= $name ?></p>
                                <?php
                                }
                            ?>
                        </div>
                        <div>
                        <h4>Colors</h4> 
                            <?php

                                foreach($colors as $color)
                                {
                                    $model = new ColorsModel();
                                    $find = $model->find(intval($color));
                                    if (!empty ($find)){
                                        $colorName = $find['name'];
                                    ?>
                                        <p><?= $colorName ?></p>
                                    <?php
                                    } else  {
                                        $colorName = '';
                                        ?>
                                        <p><?= $colorName ?></p>
                                        <?php
                                    }
                                }
                            ?>
                        </div>
                        <div>
                            <h4>Price</h4>
                            <?php
                                foreach($prices as $price)
                                {
                                ?>
                                    <p><?= $price ?>€</p>
                                <?php
                                }
                            ?>
                        </div>
                        <div>
                            <h4>Quantity</h4>
                            <?php
                                foreach($quantities as $quantity)
                                {
                                ?>
                                    <p><?= $quantity ?></p>
                                <?php
                                }
                            ?>
                        </div>
                        
                        <div>
                            <h4>Price</h4>
                            <?php
                                foreach($total_prices as $total_price)
                                {
                                    ?>
                                        <p><?= $total_price ?>€</p>
                                    <?php
                                }
                            ?>
                        </div>
                        
                    </article>
                </div>
                    <?php

                    foreach(array_unique($promos) as $promo)
                    {
                        
                        if ( $promo === "")
                        {
                            if ( $commandPrice < 50)
                            {
                                $totalPrice = $commandPrice - $deliveryPrice[0];
                            
                                ?>
                                <p>Total price : <i class="bold"><?= $totalPrice ?>€</i></p>
                                <p>Without PROMO</p>
                                <p>Delivery : <i class="bold"><?= $deliveryPrice[0] ?>€</i> (<?= $mode[0] ?>)</p>
                                <p>Total command price : <i class="bold"><?= $commandPrice ?>€</i></p>
                                <?php
                            } else {
                                $totalPrice = $commandPrice
                                ?>
                                    <p>Total price : <i class="bold"><?= $totalPrice ?>€</i></p>
                                    <p>No PROMO</p>
                                    <p>Free delivery</p>
                                    <p>Total command price : <i class="bold"><?= $commandPrice ?>€</i></p>
                                <?php
                            }
                        } else {

                            if ( $commandPrice < 50)
                            {
                                ?>
                                <p>Price without PROMO : <i class="bold"><?= $commandPrice ?>€</i></p>
                                <p>PROMO : <i class="bold"><?= $promo ?>%</i></p>
                                <p>Price with PROMO : <i class="bold"><?= $commandPricePromo ?>€</i></p>
                                <p>Delivery : <i class="bold"><?= $deliveryPrice[0] ?>€</i>  (<?= $mode[0] ?>)</p>
                                <p>Total command price : <i class="bold"><?= $commandPricePromo ?>€</i></p>
                                <?php
                            } else {
                            ?>
                                <p>Prix without PROMO : <i class="bold"><?= $commandPrice ?>€</i></p>
                                <p>PROMO : <i class="bold"><?= $promo ?>%</i></p>
                                <p>Prix with PROMO : <i class="bold"><?= $commandPricePromo ?>€</i></p>
                                <p>Free delivery</p>
                                <p>Total command price : <i class="bold"><?= $commandPricePromo ?>€</i></p>
                            <?php
                            }
                        }
                    }
                    ?>
                </article>
            </section>
        </fieldset>
        <?php
        }
        ?>

    <section  class="txt-center section-favoris">
        <hr>
        <h2 class="sous-titre">Your favorite products</h2>
        <div class="wrapper">
        <?php
            foreach($userProducts as $userProduct)
            {
                $images = explode(",", $userProduct['url_image']);
        ?>
            <div class='bestsellers-products'>
            <div class="bestsellers-img">
                <img src="uploads/<?=$images[0]?>" alt="favorite product pic">
            </div>
                <div class='intern-case'>
                    <h3><a href="products/<?= $userProduct['id_product'] ?>"><?= $userProduct['product_name'] ?></a></h3>
                    <button><p id=''>Add  -  $<?= $userProduct['product_price'] ?></p></button>  
                </div>
            </div>
        <?php
            }
        ?>
        </div>
        
    </section>
    <hr>
    <h2 class="sous-titre txt-center">Your comments</h2>
    <section class="txt-center section-comment">
       

        <?php

            foreach( $userComments as $comment) 
            {
            
        ?>
            <article>
                <a href="<?= url ?>products/<?= $comment['id_product'] ?>"><?= $comment['name'] ?></a>
                <p class="date"><?= $comment['datefr'] ?></p>
                <p><?= $comment['comment'] ?></p>
                 
            
            <?php
                $i = 0;
            ?>
                <label for=""> Note :
            <?php
                while ( $i < $comment['note'])
                {
            ?>
                    ★</label>
            <?php

                $i++;
                }
            ?>
               

                <form action="" method="post">
                    <input type="hidden" name="id_comment" value="<?= $comment['id']?>">
                    <button type="submit" name="deleteComment"><i class="fa-solid fa-trash"></i></button>
                </form>
                <hr>
            </article>
        <?php
            }
        ?>
    </section>

<?php
}
?>

