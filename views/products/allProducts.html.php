<h1>Liste de nos produits</h1>
<form action="" method="GET">
    <select name="categorie">
        <?php foreach ($sousCategories as $sousCategorie) { ?>
            <option value="<?php echo $sousCategorie['name']; ?> "><?php echo $sousCategorie['name']; ?> </option>
        <?php } ?> 
    </select>
    <input type='hidden' name='page' value='1'>
    <button type='submit' name="submit" class="formButton">Valider</button>
</form>

<?php 

if(isset($products))
{

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
    <h2><a href="products/<?= $product['id'] ?>"><?= $product['name'] ?></a></h2>
    <h3><?= $product['description'] ?></h3>
    <p><?= $product['price'] ?></p>
</div>
<?php
}
}
else
{
    foreach($productsByCategories as $product){
        ?>
        <div class="products">
            <h2><a href="products/<?= $product['id'] ?>"><?= $product['name'] ?></a></h2>
            <h3><?= $product['description'] ?></h3>
            <p><?= $product['price']?>€</p>
        </div>
    <?php
    }
}

?>

