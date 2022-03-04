
<?php
foreach($searchedProducts as $searchProduct){
    $images = explode(',', $searchProduct['url']);
?>

<div class="foundproducts">
    <?php
        foreach($images as $image){

            var_dump($image);
            ?>
            <img src="Uploads/<?= $image ?>" width="50px">
            <?php
        }
        ?>
        <h2><a href="products/<?= $searchProduct['id'] ?>"><?= $searchProduct['name'] ?></a></h2>
    </div>
    <?php
}
?>