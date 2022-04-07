<?php

if (!isset($url[1]))
{
    var_dump($findAllProducts);
} 

elseif (isset($url[1]) && !isset($url[2]))
{
    ?>
    <article class="Souscat">
        <ul class="listSousCat">
            <?php
                foreach($findSousCategories as $sousCategories)
                {   
                    
                    ?>
                    <li>
                        <a href="products/<?= $findCat[0]['name'] ?>/<?= $sousCategories['name'] ?>"><button><?= $sousCategories['name'] ?></button></a>
                    </li>

                    <?php
                }
            ?>
        </ul>
    </article>


    <?php
    var_dump($findProductByCategorie);
    var_dump($findSousCategories);
}
if (isset($url[2]))
{
    var_dump($sousCategories);
}


foreach($products as $product){
    ?>



    <?php
}

?>