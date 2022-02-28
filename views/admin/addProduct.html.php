
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
            $_POST['category'] = 2;
            // demander l'id de skincare et makeup
            var_dump($_POST['category']);
        ?>

        <label for="subcategory-select">Choose a sub-category:</label>
        <select name="subcategory" id="subcategory-select">
            <option value="cleansers">Cleansers</option>
            <option value="lotions">Lotions</option>
            <option value="serums">Serums</option>
            <option value="moisturizers">Moisturizers</option>
        </select>

        <?php
            if($_POST['subcategory'] == 'cleansers'){
                $_POST['subcategory'] = 4;
            }elseif($_POST['subcategory'] == 'lotions'){
                $_POST['subcategory'] = 3;
            }elseif($_POST['subcategory'] == 'serums'){
                $_POST['subcategory'] = 2;
            }elseif($_POST['subcategory'] == 'moisturizers'){
                $_POST['subcategory'] = 1;
            }
        }
        elseif($_POST['category'] == 'makeup')
            {
                $_POST['category'] = 1;
        ?>
        <label for="subcategory-select">Choose a sub-category:</label>
        <select name="subcategory" id="subcategory-select">
            <option value="eyes">Eyes</option>
            <option value="face">Face</option>
            <option value="lips">Lips</option>
        </select>
        <?php

            if($_POST['subcategory'] == 'eyes'){
                $_POST['subcategory'] = 6;
            }elseif($_POST['subcategory'] == 'face'){
                $_POST['subcategory'] = 5;
            }elseif($_POST['subcategory'] == 'lips'){
                $_POST['subcategory'] = 7;
            }  
        }
        ?>
<button type="submit" name="createProduct">Add the product</button>
</form>