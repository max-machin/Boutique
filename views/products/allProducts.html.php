<h1>Liste de nos produits</h1>
<form action="" method="GET">
    <select name="categorie">
        <?php foreach ($categories as $categorie) { ?>
            <option value="<?php echo $categorie['name']; ?> "><?php echo $categorie['name']; ?> </option>
        <?php } ?> 
    </select>
    <input type='hidden' name='page' value='1'>
    <button type='submit' name="submit" class="formButton">Valider</button>
</form>

<?php 
    // var_dump($categories);
    // var_dump($products);
if (isset($_GET['categorie'])) {
    

    for ($i = 1; $i <= $nbr_page_cat; $i++) {
        if ($page != $i)
            echo "<a class='page' href='?page=$i&categorie=$page_categorie'>$i</a>&nbsp";
        else
            echo "<a class='page'>$i</a>&nbsp";
    }
} 
else {
    for ($i = 1; $i <= $nbr_page; $i++) {
        if ($page != $i)
            echo "<a class='page' href='?page=$i'>$i</a>";
        else
            echo "<a class='page'>$i</a>";
    }
}

foreach($products as $product){
   
?>

 
<div class="products">
    <h2><a href="products/<?= $product['id'] ?>"><?= $product['name'] ?></a></h2>
    <h3><?= $product['description'] ?></h3>
    <p><?= $product['price']?>€</p>
</div>
<?php
}
?>

