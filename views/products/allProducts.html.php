<section class="wrapper wrapper-product">

<?php

foreach ($products as $product)
{
    $model = new CommentsModel();
    $findNote = $model->findProductNote($product['id']);

    $images = explode(',', $product['url']);
    ?>
     <div class='bestsellers-products'>
        <div class="bestsellers-img">
            <img src='uploads/<?= $images[0] ?>'>  
        </div>
        <div class='intern-case'>
            <h3><a href='products/<?= $product['id'] ?>'><?= $product['name'] ?></a></h3>
            <p><?= round($findNote[0]['note'], 2) ?> <i class="fa-solid fa-star"></i></p>
            <p><?= $product['price'] ?> €</p>
            <a href='products/<?= $product['id'] ?>'><button>Add</button></a>                      
        </div>
                       
    </div> 
    <?php
}

?>

</section>