<h1>Liste de nos produits</h1>
<?php 

foreach($products as $product){
    var_dump($product);
?>

<div class="products">
    <?php
        foreach($images as $image){
            ?>
            <img src="Uploads/<?= $image ?>" width="50px">
            <?php
        }
    ?>
    <h2><a href="products/<?= $product->id ?>"><?= $product->name ?></a></h2>
    <h3><?= $product->description ?></h3>
    <p><?= $product->price ?></p>
</div>
<?php
}
//  }
?>

