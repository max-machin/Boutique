<form action="" method="post" enctype="multipart/form-data">
    <label for="product-select">Choose which product you want to add your images:</label>

    <select name="products" id="product-select">        
        <?php
        foreach($products as $product){
        ?>
        <option value="<?= $product->id ?>"><?= $product->name ?></option>
        <?php
        }
        ?>
    </select>
    
    <input type="file" name="productImg">
    <!-- <span><?php echo $profilErr; echo $pictureErr; echo $sizeErr; ?></span> -->
    <button class="boutonsauv" type="submit" name="sauvimg" value="Sauvegarder">Sauvegarder</button>
</form>
