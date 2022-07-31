<div class='wrapper'>
    <?php
    foreach($searchedProducts as $searchProduct){
        $images = explode(',', $searchProduct['url']);
        var_dump($searchProduct);
    ?>
        <div class='found-products'>
            <!-- <div class="bestsellers-img"> -->
                    <!-- <div class="searchbarimg"> -->
                        <img src="<?= url ?>uploads/<?= $images[0] ?>" width="50px" alt="image de résultat de recherche">
                        <h2><a href="<?= url ?>products/<?= $searchProduct['id'] ?>"><?= $searchProduct['name'] ?></a></h2>
                    </div>
            <?php
            }
            ?>
