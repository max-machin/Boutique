<h1>Liste de nos produits</h1>
<form action="" method="GET">
    <select name="categorie">
        <?php foreach ($categories as $categorie) { ?>
            <option value="<?php echo $categorie['name_categorie']; ?> "><?php echo $categorie['name_categorie']; ?> </option>
        <?php } ?>
    </select>
    <input type='hidden' name='page' value='1'>
    <button type='submit' name="submit" class="formButton">Valider</button>
</form>

<?php 
    var_dump($products);
    
foreach($products as $product){
    // var_dump($model->productsByPage($nbr_product_par_page, $debut));
?>

 
<div class="products">
    <h2><a href="products/<?= $product['id'] ?>"><?= $product['name'] ?></a></h2>
    <h3><?= $product['description'] ?></h3>
    <p><?= $product['price']?>€</p>
</div>
<?php
}
?>

