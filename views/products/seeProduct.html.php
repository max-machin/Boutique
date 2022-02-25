<?php
require_once('libraries/Renderer.php');
?>
<?php

if(@$_SERVER['user_data']['id'] == 1)
{
    ?>

    <h1><?= $product->name ?></h1>

<?php var_dump($product);?>

    <form action="<?= $product->id ?>/update" method="post">  
        <input type="hidden" name="id" value="<?= $product->id ?>"/>          
        <button class="#" type="submit" name="updateProduct">Update</button>
    </form>

<?php

} else
{
    ?>
    <h1><?= $product->name ?></h1>

    <?php var_dump($product);

    if(isset($_POST['addBag']))
    {
    $_SESSION['product']['id'] = $product->id;
    BagsController::insertBag();
    }

    ?>

        <form action="" method="post">           
            <button class="#" type="submit" name="addBag">Add</button>
        </form>
    <?php
}

