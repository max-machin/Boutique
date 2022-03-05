<h1>My bag</h1>
<?php

if ( isset ( $_SESSION['user_data']))
{
    $bagQuantity = 0;
    $bagPrice = 0;
    if ( !empty ( $bagProducts))
    {
        foreach($bagProducts as $bagProduct)
        {
            // Calcul du prix total d'un produit = Prix unitaire * quantité
            $productsPrice = $bagProduct['price'] * $bagProduct['quantity_product'];

            // Calcul du prix du panier 
            $bagPrice += $productsPrice;
            
            $bagQuantity += $bagProduct['quantity_product'];
        
?>
        <article class="bag">
            <p><a href="<?= url ?>products/<?= $bagProduct['id'] ?>"><?= $bagProduct['name'] ?></a></p>
            <p> <?= $bagProduct['price'] ?>€/u</p>
            
            <form action="" method="post">
                <select name="quantity" id="">
                    <option value="<?= $bagProduct['quantity_product']?>" selected > Quantité : <?= $bagProduct['quantity_product']?></option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                <input type="hidden" name="idProduct" value=" <?= $bagProduct['id'] ?>">
                <input type="submit" name="submitQuantity" value="⟳">
            </form> 

            <h3><?= $productsPrice ?>€</h3>

            <form method="post">
                <input type="hidden" name="idProduct" value="<?= $bagProduct['id'] ?>"/>           
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
    } else 
    {
    ?>
        <p>Votre panier est vide</p>
    <?php
    }
} else {
    header("Location: ..users/login");
}

?>

