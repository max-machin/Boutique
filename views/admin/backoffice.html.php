<?php

if(@$_SERVER['user_data']['id'] !== 1)
{
    header('Location:../index');
}

?>

<form action="<?=urlLaura ?>admin/create" method="post">
    <button type="submit" name="goCreate">Create a new product</button>   
</form>

<form action="<?=urlLaura ?>admin/update" method="post">
    <button type="submit" name="goUpdate">Update a product</button>   
</form>

<!--  
    
    - update product va directement emmener sur une page qui recense tous les produits existants puis chaque produit -> next to it, un bouton update qui ramène à l'update(déjà fait).
    Y aura aussi un bouton update d'images à côté de chaque produit, qui lui emmènera à une page qui recense toutes les images (update via l'id)

    - voir tous les users ?

    - voir toutes les commandes ou lien vers les chiffres d'affaire

-->
