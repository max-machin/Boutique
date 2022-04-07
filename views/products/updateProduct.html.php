<?php
if(@$_SESSION['user_data']['id'] == 1)
{



if(isset($_POST['saveUpdate'])){
    $_SESSION['product']['id']=$product['id'];
    $_SESSION['product']['name']=$_POST['name'];
    $_SESSION['product']['price']=$_POST['price'];
    $_SESSION['product']['description']=$_POST['description'];

    ProductsController::updateProduct();
}

?>

 <form action="" method="post">
         <label for="name">Name of the product</label>
         <input type="text" name="name" id="name" value="<?=$product['name']?>"/> 
         <label for="description">Description</label>
         <textarea id="description" name="description"
           rows="5" cols="33">
           <?= $product['description'] ?>
         </textarea>
         <label for="price">Price of the product</label>
         <input type="text" name="price" id="price" value="<?=$product['price']?>"/>
         <label for="description">Tags</label>
         <textarea id="tags" name="tags"
           rows="5" cols="10">
           <?= $product['tags'] ?>
         </textarea>
 <button type="submit" name="saveUpdate">Save the changes</button>
 </form>
 <?php
}
else {
  header('Location:../accueil');
}

?>