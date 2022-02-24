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

