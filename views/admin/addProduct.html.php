<?php

if(@$_SESSION['user_data']['id'] !== "1")
{
    header('Location:../index');
}


    if(isset($_POST['createProduct']))
    {
        if($_POST['category'] == 'skincare')
        {
            $_SESSION['category']['id'] = 2;

            if($_POST['subcategory'] == 'cleansers'){
                $_SESSION['subcategory']['id'] = 4;
            }elseif($_POST['subcategory'] == 'lotions'){
                $_SESSION['subcategory']['id'] = 3;
            }elseif($_POST['subcategory'] == 'serums'){
                $_SESSION['subcategory']['id'] = 2;
            }elseif($_POST['subcategory'] == 'moisturizers'){
                $_SESSION['subcategory']['id'] = 1;
            }

        }
        else{
            $_SESSION['category']['id'] = 1;

            if($_POST['subcategory'] == 'eyes'){
                $_SESSION['subcategory']['id'] = 6;
            }elseif($_POST['subcategory'] == 'face'){
                $_SESSION['subcategory']['id'] = 5;
            }elseif($_POST['subcategory'] == 'lips'){
                $_SESSION['subcategory']['id'] = 7;
            }  
        }
        ProductsController::createProduct();
    }
?>

        <form action="" method="post">
        <label for="name">Name of the product</label>
        <input type="text" name="name" id="name"/> 

        <label for="description">Description</label>
        <textarea id="description" name="description"
          rows="5" cols="33">
        </textarea>

        <label for="price">Price of the product</label>
        <input type="text" name="price" id="price"/>

        <label for="category-select">Choose a category:</label>
        <select name="category" id="category-select">
            <option value="skincare">Skincare</option>
            <option value="makeup">Make-up</option>
        </select>

        <?php

        if($_POST['category'] == 'skincare')
        {
        ?>

        <label for="subcategory-select">Choose a sub-category:</label>
        <select name="subcategory" id="subcategory-select">
            <option value="cleansers">Cleansers</option>
            <option value="lotions">Lotions</option>
            <option value="serums">Serums</option>
            <option value="moisturizers">Moisturizers</option>
        </select>

        <?php
        }
        elseif($_POST['category'] == 'makeup')
            {
        ?>
        <label for="subcategory-select">Choose a sub-category:</label>
        <select name="subcategory" id="subcategory-select">
            <option value="eyes">Eyes</option>
            <option value="face">Face</option>
            <option value="lips">Lips</option>
        </select>
        <?php
        }
        ?>
<button type="submit" name="getTheSubCate">Get the subcategories</button>
<?php
    if(isset($_POST['getTheSubCate'])){
?>
<button type="submit" name="createProduct">Add the product</button>
<?php
    }
?>
</form>