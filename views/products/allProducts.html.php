<h1>Liste de nos produits</h1>
<?php 
foreach($products as $product){
    var_dump($product);
?>
<div class="products">
    <h2><a href="products/<?= $product->id_product ?>"><?= $product->name ?></a></h2>
    <h3><?= $product->description ?></h3>
    <p><?= $product->price ?></p>
</div>
<?php
}
?>

