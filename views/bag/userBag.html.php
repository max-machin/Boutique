<h1>My bag</h1>
<?php

// Si l'utilisateur est connecté
if ( isset ( $_SESSION['user_data']))
{
    // Initialisation de la quantité et du prix du panier
    $bagQuantity = 0; 
    $bagPrice = 0;
    // Si des produits avec / sans COULEUR sont ajouté en panier
    if ( !empty ( $bagProductsColors) || !empty ($bagProducts))
    {
        // Affichage des produits possédant une couleur
        foreach($bagProductsColors as $bagProduct)
        {
            // Calcul du prix total d'un produit = Prix unitaire * quantité
            $productsPrice = $bagProduct['price'] * $bagProduct['quantity_product'];

            // Calcul du prix du panier 
            $bagPrice += $productsPrice;
            
            // Calcul de la quantité
            $bagQuantity += $bagProduct['quantity_product'];
        
        ?>

        <article class="bag">
            <p><a href="<?= url ?>products/<?= $bagProduct['id'] ?>"><?= $bagProduct['name'] ?></a></p>
            <p> <?= $bagProduct['price'] ?>€/u</p>

            <form action="" method="post">

            <article class="product_color">
                    <label class="color" for="<?= $bagProduct['color_name'] ?>" style="background-color: #<?= $bagProduct['code'] ?>">
                        
                    </label>
            </article>

                <select name="quantityColors" id="">
                    <option value="<?= $bagProduct['quantity_product']?>" selected > Quantité : <?= $bagProduct['quantity_product']?></option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                <input type="hidden" name="id_color" value="<?= $bagProduct['id_color'] ?>">
                <input type="hidden" name="idProductColors" value=" <?= $bagProduct['id'] ?>">
                <input type="submit" name="submitQuantityColors" value="⟳">

            <h3><?= $productsPrice ?>€</h3>

                <input type="hidden" name="idProductColors" value="<?= $bagProduct['id'] ?>"/>           
                <button class="#" type="submit" name="deleteFromBagColors">Remove</button>
            </form>
        </article>
    
        <?php
        } 

        foreach ($bagProducts as $product)
        {
            // Calcul du prix total d'un produit = Prix unitaire * quantité
            $productsPrice = $product['price'] * $product['quantity_product'];

            // Calcul du prix du panier 
            $bagPrice += $productsPrice;
            
            $bagQuantity += $product['quantity_product'];
    
        ?>

        <article class="bag">
                <p><a href="<?= url ?>products/<?= $product['id'] ?>"><?= $product['name'] ?></a></p>
                <p> <?= $product['price'] ?>€/u</p>

                <form action="" method="post">

                    <select name="quantity" id="">
                        <option value="<?= $product['quantity_product']?>" selected > Quantité : <?= $product['quantity_product']?></option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    <input type="hidden" name="idProduct" value=" <?= $product['id'] ?>">
                    <input type="submit" name="submitQuantity" value="⟳">

                <h3><?= $productsPrice ?>€</h3>

                    <input type="hidden" name="idProduct" value="<?= $product['id'] ?>"/>           
                    <button class="#" type="submit" name="deleteFromBag">Remove</button>
                </form>
            </article>
        
        <?php
        } 
        ?>

        <h2>Sous-total (<?= $bagQuantity ?> articles) : <?= $bagPrice ?>€.</h2>
        <form action="" method="post">
            <input type="submit" name="command" value="Passez commande">
        </form>

    <?php
    } 
        else 
    {
    ?>
        <p>Votre panier est vide</p>

    <?php
    }
} else {
    header("Location: ..users/login");
}


