<?php
require_once('libraries/Renderer.php');
?>

    <h1><?= $product->name ?></h1>

<?php var_dump($product);

    // if(isset($_POST['updateProduct']))
    // {
    //     $_SESSION['product']['id'] = $_POST['updateProduct'];
    //     Renderer::render('products/updateProduct');
    // }

?>

    <form action="<?= $product->id ?>/update" method="post">  
        <input type="hidden" name="id" value="<?= $product->id ?>"/>          
        <button class="#" type="submit" name="updateProduct">Update</button>
    </form>



