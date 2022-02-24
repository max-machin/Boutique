<h1>My bag</h1>
<?php

if(isset($_POST['choose']))
{
    $_SESSION['bag']['quantity'] = $_POST['quantity'];
    $_SESSION['bag']['id_product'] = $_POST['id'];
    BagsController::quantityBag();
}

if(isset($_POST['deleteFromBag']))
{
    $_SESSION['bag']['id_product'] = $_POST['id'];
    // var_dump($_SESSION['bag']['id_product']);
    BagsController::deleteFromBag();
    header('Location: http://localhost:8080/Boutique/bags/');
}

foreach($bagProducts as $bagProduct)
{
    ?>
<div class="bag">
<p><a href="products/<?= $bagProduct->id ?>"><?= $bagProduct->name ?></a> <?= $bagProduct->price ?></p> 
<form action="http://localhost:8080/Boutique/bags/delete" method="post">
    <input type="hidden" name="id" value="<?= $bagProduct->id ?>"/>           
    <button class="#" type="submit" name="deleteFromBag">Remove</button>
</form>
<form action="" method="post">
    <label for="quantity">Quantity (between 1 and 5):</label>
    <input type="number" id="quantity" name="quantity" min="1" max="5">
    <input type="hidden" name="id" value="<?= $bagProduct->id ?>"/> 
    <button class="#" type="submit" name="choose">choose</button>
    <!-- <input type="submit" name="submit2" value="choose"> -->
</form>
</div>



    <?php
}

?>

