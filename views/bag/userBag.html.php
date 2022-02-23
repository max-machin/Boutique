<h1>My bag</h1>
<?php
foreach($bagProducts as $bagProduct)
{

    ?>
<div class="bag">
<p><a href="products/<?= $bagProduct->id ?>"><?= $bagProduct->name ?></a> <?= $bagProduct->price ?></p>
</div>

    <?php
}

?>

