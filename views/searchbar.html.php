<div class='wrapper'>
    <?php
    foreach($searchedProducts as $searchProduct){
        $images = explode(',', $searchProduct['url']);
    ?>
        <div class='found-products'>
            <!-- <div class="bestsellers-img"> -->
                    <!-- <div class="searchbarimg"> -->
                        <img src="uploads/<?= $images[0] ?>" width="50px" alt="image de résultat de recherche">
                        <h2><a href="products/<?= $searchProduct['id'] ?>"><?= $searchProduct['name'] ?></a></h2>
                    </div>
            <?php
            }
            ?>
