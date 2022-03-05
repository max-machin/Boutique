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

//  }
    // var_dump($categories);
    // var_dump($products);
    // echo 'heloooo';
    // var_dump($_GET);
    // echo 'heloooo';
    // var_dump($sousCategories);

// if (isset($_GET['categorie'])) {
    
//  $page_categorie = $_GET['categorie']; 
//     for ($i = 1; $i <= $nbr_page_cat; $i++) {
//         if ($page != $i)
//             echo "<a class='page' href='?page=$i&categorie=$page_categorie'>$i</a>&nbsp";
//         else
//             echo "<a class='page'>$i</a>&nbsp";
//     }
// } 
// else {
//     for ($i = 1; $i <= $nbr_page; $i++) {
//         if ($page != $i)
//             echo "<a class='page' href='?page=$i'>$i</a>";
//         else
//             echo "<a class='page'>$i</a>";
//     }
// }


if(isset($products))
{

foreach($products as $product){
    var_dump($product);
    $images = explode(',', $product['url']);
    var_dump($images);
     
?>

<div class="products">
    <?php
        foreach($images as $image){

            var_dump($image);
            ?>
            <img src="Uploads/<?= $image ?>" width="50px">
            <?php
        }
    ?>
    <h2><a href="<?= url ?>products/<?= $product['id'] ?>"><?= $product['name'] ?></a></h2>
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