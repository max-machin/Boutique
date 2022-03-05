<h1>Validez votre commande</h1>
<?php
    if ( !empty ( $command ) )
    {
        $commandQuantity = 0;
        $commandPrice = 0;
        
        if ( $_SESSION['user_data']['promo'] === 1)
        {
            

            foreach ( $command as $product)
            {

                // Prix total de chaque produit
                $productPrice = $product['price'] * $product['quantity_product'];

                // Prix total du panier avec promo
                $promo = intval($product['price']) * 0.15;
                $productPricePromo = $product['price'] - $promo;
                $productPricePromo *= $product['quantity_product'];
                $commandPrice += $productPricePromo;
                $commandQuantity += $product['quantity_product'];

            ?>
                <article>
                    <p><?= $product['name'] ?></p>
                    <p> <?= $product['price'] ?>€/u</p>
                    <h3><?= $productPrice ?>€ (quantité : <?= $product['quantity_product'] ?>)</h3>
                </article>

                <h3>Total (<?= $commandQuantity ?> articles) : </h3>
                <p>(-15% grâce au code PROMO)</p>

                <form action="paiement" method="post">
                    <input type="text" name="prix" id="prix" value="<?= $commandPrice ?>" readonly><br>
                    <button>Procédez au paiement</button>
                </form>
            <?php
            }
        } else {

            foreach ($command as $product)
            { 
                $productPrice = $product['price'] * $product['quantity_product'];
                $commandPrice += $productPrice;
                $commandQuantity += $product['quantity_product'];
?>
                <article>
                    <p><?= $product['name'] ?></p>
                    <p> <?= $product['price'] ?>€/u</p>
                    <h3><?= $productPrice ?>€ (quantité : <?= $product['quantity_product'] ?>)</h3>
                </article>

                <form action="" method="post">
                    <input type="text" name="codePromo" placeholder="CODE PROMO">
                    <input type="submit" name="promo" value="Appliquez PROMO">
                </form>

                <h3>Total (<?= $commandQuantity ?> articles) : </h3>
                <form action="paiement" method="post">
                    <input type="text" name="prix" id="prix" value="<?= $commandPrice ?>" readonly><br>
                    <button>Procédez au paiement</button>
                </form>
<?php
            }
        }

    } else {
?>
    <article>
        <p>Ajouter des produits pour procédez à une commande</p>
        <a href="<?= url ?>products">Nos produits</a>
    </article>

<?php 
    }
?>