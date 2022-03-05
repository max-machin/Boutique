<?php
    echo 'je suis dans backoffice';
?>

<form action="admin/addProduct.html.php" method="post">
    <button type="submit" name="goCreate">Create a new product</button>   
</form>

<form action="" method="post">
    <button type="submit" name="goUpdate">Update a product</button>   
</form>

<!--  
    
    - update product va directement emmener sur une page qui recense tous les produits existants puis chaque produit -> next to it, un bouton update qui ramène à l'update(déjà fait).
    Y aura aussi un bouton update d'images à côté de chaque produit, qui lui emmènera à une page qui recense toutes les images (update via l'id)

    - create dans le truc addProduct avec ensuite un bouton qui dirige vers l'upload d'images

    - voir tous les users ?

    - voir toutes les commandes ou lien vers les chiffres d'affaire

-->
