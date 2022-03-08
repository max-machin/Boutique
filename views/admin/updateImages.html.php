<?php
    echo 'okayyyyy letsgooooowwwwww';

    foreach($images as $img)
    {
        ?>

<h2><a href="<?= urlLaura ?>products/<?= $product['id'] ?>"><?= $product['name'] ?></a></h2>

        <?php
    }
?>