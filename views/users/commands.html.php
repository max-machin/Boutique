<h1 class="txt-center sous-titre">Validez votre commande</h1>
<section class="content">
<?php

if ( isset ($_SESSION['user_data'] ))
{
    // Si des produits avec / sans CHOIX COULEUR sont présent dans le panier
    if ( !empty ( $command ) || !empty ( $commandColors) )
    {
        // Initialisation des variables qui récupereront la somme des quantités du prix
        $commandQuantity = 0;
        $commandPrice = 0;
        
        // Si un code promo est reconnu
        if ( $_SESSION['user_data']['promo'] === 1)
        {
            // Affichage des produits avec COULEUR
            foreach ( $commandColors as $productColors)
            {
                $imagesColor = explode(",", $imagesColors['url_image']);

                // Prix total de chaque produit
                $productPrice = $productColors['price'] * $productColors['quantity_product'];

                /**
                 * On calcule la promo sur le prix du produit (15€ * O,15)
                 * On retire le résultat calculé précedemment au prix du produit
                 * On multiplie le prix unitaire du produit * par sa quantité pour faire un total par produit
                 * On additione le prix total de tout les produits aprés promo pour total de la commande
                 * Egal pour la quantité
                 */
                $promo = intval($productColors['price']) * 0.15;
                $productPricePromo = $productColors['price'] - $promo;
                $productPricePromo *= $productColors['quantity_product'];
                $commandPrice += $productPricePromo;
                $commandQuantity += $productColors['quantity_product'];

            ?>
            <section class="command txt-center">
                <div class="cont">
                    <h3 class="sous-titre"><?= $productColors['name'] ?></h3>
                    <img src="<?= url ?>Uploads/<?= $imagesColor[0] ?>" alt="" width="200px" height="260px">

                    <article class="produit flex txt-center">
                        <label for="color" name="color" class="color" style="background-color: #<?= $productColors['code'] ?>"> </label>
                        <p> <?= $productColors['price'] ?>€/u</p>
                        <p>x <?= $productColors['quantity_product'] ?></p>
                        <h3><?= $productPrice ?>€</h3>
                    </article>
                </div>
            <?php
            }
            // affichage des produits sans couleur
            foreach ( $command as $product)
            {
                $images = explode(",", $images['url_image']);
                // Prix total de chaque produit
                $productPrice = $product['price'] * $product['quantity_product'];

                
                /**
                 * On calcule la promo sur le prix du produit (15€ * O,15)
                 * On retire le résultat calculé précedemment au prix du produit
                 * On multiplie le prix unitaire du produit * par sa quantité pour faire un total par produit
                 * On additione le prix total de tout les produits aprés promo pour total de la commande
                 * Egal pour la quantité
                 */
                $promo = intval($product['price']) * 0.15;
                $productPricePromo = $product['price'] - $promo;
                $productPricePromo *= $product['quantity_product'];
                $commandPrice += $productPricePromo;
                $commandQuantity += $product['quantity_product'];

            ?>
                <div class="cont">
                    <h3 class="sous-titre"><?= $product['name'] ?></h3>
                    <img src="<?= url ?>Uploads/<?= $images[0] ?>" alt="" width="200px" height="260px">
                    <article class="produit flex">
                        <p> <?= $product['price'] ?>€/u</p>
                        <p>x <?= $product['quantity_product'] ?></p>
                        <h3><?= $productPrice ?>€</h3>
                    </article>
                </div>
            <?php
            }
            ?> 
                
                <form class="form" action="paiement" method="post">
                <h2 >Livraison</h2>
                <?php
                if ( $commandPrice < 50)
                {
                
                    foreach($findDeliveries as $delivery)
                    {
                        $delai = explode(".", $delivery['delai']);
                        $price = str_replace(".", "," , $delivery['price']);
                        
                    ?> 
                        <input id="delivery<?= $delivery['id'] ?>" type="radio" name="mode" value="<?= $delivery['mode']?>">
                        <label for="delivery<?= $delivery['id'] ?>">
                            <p>Livraison : <?= $delivery['mode'] ?></p>

                        <?php 
                            if (isset ($delai[1]))
                            {
                        ?>
                            <p>Délai : <?= $delai[0] ?> / <?= $delai[1] ?></p>
                        <?php
                            } else {
                        ?>
                            <p>Délai : <?= $delai[0] ?> </p>
                        
                        
                            <?php
                            }
                        ?>
                            <p>Prix : <?= $price ?>€</p>
                        <?php
                    } 
                } else {   
                ?>
                    <p>Frais de livrasion offerts</p>
                <?php
                }  
                ?>

                        </label>
                
                <form class="form" action="paiement" method="post">
                    <h3>Informations livraison</h3>
                    <div class="form-group">
                        <input type="text" name="adresse" id="adresse" placeholder="Adresse">
                        <label for="adresse">Adresse *</label>
                    </div>

                    <div class="form-group">
                        <input type="text" name="codePostale" id="codePostale" placeholder="Code postale">
                        <label for="codePostale">Code postale *</label>
                    </div>

                    <div class="form-group">                      
                        <input type="text" name="ville" id="ville" placeholder="Ville">
                        <label for="ville">Ville *</label>
                    </div>
                    
                    <div class="form-group">    
                        <input type="text" name="facturation" id="facturation" value="<?= $_SESSION['user_data']['email'] ?>">
                        <label for="facturation">Email de facturation *</label>
                    </div>
                    

                    <h2>Total (<?= $commandQuantity ?> articles) : </h2>

                    <input type="text" name="prix" id="prix" value="<?= $commandPrice ?>€" readonly><br>
                    <button class="submit"name="paiement_button">Procédez au paiement</button><br>
                    <p class="help">* Le prix total ne comprend pas le prix de livraison</p>

                    <?= $error ?><br>

                </form>
            </section>
            <?php
        // Si aucun code PROMO n'est entré
        } else {
            // affichage des produits avec couleur
            foreach ($commandColors as $productColor)
            { 
                $images = explode(",",$productColor['url_image']);
                /**
                 * On calcule le prix total pour un produit : prix unitaire * quantité
                 * On additione tous les prix totaux au total de la commandes
                 * Egal pour la quantité
                 */
                $productPrice = $productColor['price'] * $productColor['quantity_product'];
                $commandPrice += $productPrice;
                $commandQuantity += $productColor['quantity_product'];

            ?>
            <section class="command txt-center">
                <div class="cont">
                    <h3 class="sous-titre"><?= $productColor['name'] ?></h3>
                    <img src="<?= url ?>Uploads/<?= $images[0] ?>" alt="" width="200px" height="260px">
                    

                    <article class="produit flex">
                        <label for="color" name="color" class="color" style="background-color: #<?= $productColor['code'] ?>"> </label>
                        <p> <?= $productColor['price'] ?>€/u</p>
                        <p>x <?= $productColor['quantity_product'] ?></p>
                        <h3><?= $productPrice ?>€</h3>
                    </article>   
                </div>
            <?php
            }
            // Affichage des produits sans COULEUR
            foreach ($command as $product)
            { 
                $images = explode(",",$product['url_image']);
                /**
                 * On calcule le prix total pour un produit : prix unitaire * quantité
                 * On additione tous les prix totaux au total de la commandes
                 * Egal pour la quantité
                 */
                $productPrice = $product['price'] * $product['quantity_product'];
                $commandPrice += $productPrice;
                $commandQuantity += $product['quantity_product'];
            ?>
            <div class="cont">
                <h3 class="sous-titre"><?= $product['name'] ?></h3>
                <img src="<?= url ?>Uploads/<?= $images[0] ?>" alt="" width="200px" height="260px">
                <article class="produit flex">
                    <p> <?= $product['price'] ?>€/u</p>
                    <p>x <?= $product['quantity_product'] ?></p>
                    <h3><?= $productPrice ?>€</h3>
                </article>  
            </div>
            <?php
            }
            ?>

                
                <form class="form" action="paiement" method="post">
                <h2>Livraison</h2>
                <?php
                if ( $commandPrice < 50)
                {
                    foreach($findDeliveries as $delivery)
                    {
                        $delai = explode(".", $delivery['delai']);
                        $price = str_replace(".", "," , $delivery['price']);
                    ?> 
                        <input id="delivery<?= $delivery['id'] ?>" type="radio" name="mode" value="<?= $delivery['mode']?>">
                        <label for="delivery<?= $delivery['id'] ?>">
                            <p>Livraison : <?= $delivery['mode'] ?></p>

                        <?php 
                            if (isset ($delai[1]))
                            {
                        ?>
                            <p>Délai : <?= $delai[0] ?> / <?= $delai[1] ?></p>
                        <?php
                            } else {
                        ?>
                            <p>Délai : <?= $delai[0] ?> </p>
                        
                        
                            <?php
                            }
                        ?>
                            <p>Prix : <?= $price ?> </p>
                        <?php
                    }   
                } else {
                    ?>
                        <p class="help">Frais de livrasion offerts</p>
                    <?php
                }
                ?>

                        </label>
                <h3>Informations livraison</h3>

                <div class="form-group">
                    <input type="text" name="adresse" id="adresse" required>
                    <label for="adresse">Adresse *</label>
                </div>

                <div class="form-group">
                    <input type="text" name="codePostale" id="codePostale" required>
                    <label for="codePostale">Code postale *</label>
                </div>

                <div class="form-group">
                    <input type="text" name="ville" id="ville" required>
                    <label for="ville">Ville *</label>
                </div>    
                
                <div class="form-group">
                    
                    <input type="text" name="facturation" id="facturation" value="<?= $_SESSION['user_data']['email'] ?>" required>
                    <label for="facturation">Email de facturation *</label>
                </div>

                    <h2>Total (<?= $commandQuantity ?> articles) : </h2>

                    <input type="text" name="prix" id="prix" value="<?= $commandPrice ?>€" readonly><br>
                    <button class="submit"name="paiement_button">Procédez au paiement</button><br>
                    <p class="help">* Le prix total ne comprend pas le prix de livraison</p>

                    <?= $error ?><br>

                </form>
                <form action="" method="post">
                    <input type="text" name="codePromo" placeholder="CODE PROMO">
                    <input type="submit" name="promo" value="Appliquez PROMO">
                </form>
            </section>
            <?php
        } 
    // Si aucun produit n'est ajouté en panier 
    } else {
?>
</section>

    <article>
        <p>Ajouter des produits pour procédez à une commande</p>
        <a href="<?= url ?>products">Nos produits</a>
    </article>

<?php 
    } 
} 
    else
{
    header('location: login');
}
