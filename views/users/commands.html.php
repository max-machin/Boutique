<h1>Validez votre commande</h1>
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

                <article class="product">
                    <p><?= $productColors['name'] ?></p>
                    <p> <?= $productColors['price'] ?>€/u</p>
                    <h3><?= $productPrice ?>€ (quantité : <?= $productColors['quantity_product'] ?>)</h3>

                    <label for="color" name="color" class="color" style="background-color: #<?= $productColors['code'] ?>">
                        <input type="radio">
                    </label>
                </article>
            <?php
            }
            // affichage des produits sans couleur
            foreach ( $command as $product)
            {

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
                <article class="product">
                    <p><?= $product['name'] ?></p>
                    <p> <?= $product['price'] ?>€/u</p>
                    <h3><?= $productPrice ?>€ (quantité : <?= $product['quantity_product'] ?>)</h3>
                </article>

            <?php
            }
            ?> 
                
                <form action="paiement" method="post">
                    <h3>Infomartions livraison</h3>
                    <label for="adresse">Adresse *</label><br>
                    <input type="text" name="adresse" id="adresse" placeholder="Adresse"><br>

                    <label for="codePostale">Code postale *</label><br>
                    <input type="text" name="codePostale" id="codePostale" placeholder="Code postale"><br>

                    <label for="ville">Ville *</label><br>
                    <input type="text" name="ville" id="ville" placeholder="Ville"><br>
                    
                    <label for="facturation">Email de facturation *</label><br>
                    <input type="text" name="facturation" id="facturation" value="<?= $_SESSION['user_data']['email'] ?>"><br>
                    

                    <h3>Total (<?= $commandQuantity ?> articles) : </h3>

                    <input type="text" name="prix" id="prix" value="<?= $commandPrice ?>" readonly><br>
                    <button>Procédez au paiement</button><br>

                    <?= $error ?><br>

                </form>
                
            <?php
        // Si aucun code PROMO n'est entré
        } else {
            // affichage des produits avec couleur
            foreach ($commandColors as $productColor)
            { 
                /**
                 * On calcule le prix total pour un produit : prix unitaire * quantité
                 * On additione tous les prix totaux au total de la commandes
                 * Egal pour la quantité
                 */
                $productPrice = $productColor['price'] * $productColor['quantity_product'];
                $commandPrice += $productPrice;
                $commandQuantity += $productColor['quantity_product'];

            ?>

                <article>
                    <p><?= $productColor['name'] ?></p>
                    <p> <?= $productColor['price'] ?>€/u</p>
                    <h3><?= $productPrice ?>€ (quantité : <?= $productColor['quantity_product'] ?>)</h3>
                    <label for="color" name="color" class="color" style="background-color: #<?= $productColor['code'] ?>">
                        <input type="radio">
                    </label>
                </article>   

            <?php
            }
            // Affichage des produits sans COULEUR
            foreach ($command as $product)
            { 
                /**
                 * On calcule le prix total pour un produit : prix unitaire * quantité
                 * On additione tous les prix totaux au total de la commandes
                 * Egal pour la quantité
                 */
                $productPrice = $product['price'] * $product['quantity_product'];
                $commandPrice += $productPrice;
                $commandQuantity += $product['quantity_product'];
            ?>
                <article>
                    <p><?= $product['name'] ?></p>
                    <p> <?= $product['price'] ?>€/u</p>
                    <h3><?= $productPrice ?>€ (quantité : <?= $product['quantity_product'] ?>)</h3>
                </article>  

            <?php
            }
            ?>

             <form action="" method="post">
                    <input type="text" name="codePromo" placeholder="CODE PROMO">
                    <input type="submit" name="promo" value="Appliquez PROMO">
                </form>

            
                <form action="paiement" method="post">
                    <h3>Infomartions livraison</h3>
                    <label for="adresse">Adresse *</label><br>
                    <input type="text" name="adresse" id="adresse" placeholder="Adresse"><br>

                    <label for="codePostale">Code postale *</label><br>
                    <input type="text" name="codePostale" id="codePostale" placeholder="Code postale"><br>

                    <label for="ville">Ville *</label><br>
                    <input type="text" name="ville" id="ville" placeholder="Ville"><br>
                    
                    <label for="facturation">Email de facturation *</label><br>
                    <input type="text" name="facturation" id="facturation" value="<?= $_SESSION['user_data']['email'] ?>"><br>
                    

                    <h3>Total (<?= $commandQuantity ?> articles) : </h3>

                    <input type="text" name="prix" id="prix" value="<?= $commandPrice ?>" readonly><br>
                    <button>Procédez au paiement</button><br>

                    <?= $error ?><br>

                </form>

            <?php
        } 
    // Si aucun produit n'est ajouté en panier 
    } else {
?>

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
