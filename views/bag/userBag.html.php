<h1>My bag</h1>
<?php

foreach($bagProducts as $bagProduct)
{
    ?>
<div class="bag">
<p><a href="products/<?= $bagProduct->id ?>"><?= $bagProduct->name ?></a> <?= $bagProduct->price ?></p> 
<form action="" method="post">
    <input type="hidden" name="id" value="<?= $bagProduct->id ?>"/>           
    <button class="#" type="submit" name="deleteFromBag">Remove</button>
</form>
</div>

    <?php
}

if(isset($_POST['deleteFromBag']))
{
    $_SESSION['bag']['id_product'] = $_POST['id'];
    // var_dump($_SESSION['bag']['id_product']);
    BagsController::deleteFromBag();
}

?>

