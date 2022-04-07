<?php

if (!isset($url[1]))
{
    // var_dump($findAllProducts);
?>
<article class = "allProducts_wrapper">
<?php
    foreach($findAllProducts as $allProducts) {
        $images = explode(',', $allProducts['url']);
        ?>
        <div class='bestsellers-products'>
            <div class="bestsellers-img">
                <img src='uploads/<?= $images[0] ?>'/>  
            </div>
            <div class='intern-case'>
                <h3><a href='products/<?= $allProducts['id'] ?>'><?= $allProducts['name'] ?></a></h3>
                <button><p id=''>Add  -  $<?= $allProducts['price'] ?></p></button>                         
            </div>
                
        </div> 
        <?php
    }
    ?>
    </article>
    <?php  
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

    <article class = "allProducts_wrapper">
    <?php
        foreach($findProductByCategorie as $allProductsCat) {
            $images = explode(',', $allProductsCat['url']);
            ?>
            <div class='bestsellers-products'>
                <div class="bestsellers-img">
                    <img src='uploads/<?= $images[0] ?>'/>  
                </div>
                <div class='intern-case'>
                    <h3><a href='products/<?= $allProductsCat['id'] ?>'><?= $allProductsCat['name'] ?></a></h3>
                    <button><p id=''>Add  -  $<?= $allProductsCat['price'] ?></p></button>                         
                </div>
                    
            </div> 
            <?php
        }
        ?>
        </article>
 <?php
}
if (isset($url[2]))
{
    ?>
   <article class = "allProducts_wrapper">

   <?php
        foreach($findProductBySousCategorie as $allProductsSsCat) {
            $images = explode(',', $allProductsSsCat['url']);
            ?>
         <div class='bestsellers-products'>
                <div class="bestsellers-img">
                    <img src='uploads/<?= $images[0] ?>'/>  
                </div>
                <div class='intern-case'>
                    <h3><a href='products/<?= $allProductsSsCat['id'] ?>'><?= $allProductsSsCat['name'] ?></a></h3>
                    <button><p id=''>Add  -  $<?= $allProductsSsCat['price'] ?></p></button>                         
                </div>
                    
            </div> 
            <?php
        }
        ?>
        </article>
<?php
}

?>