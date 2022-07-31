<section  class="delete-section delete-section-product">
    <a href="admin" class="return"><i class="fa-solid fa-arrow-left"></i></a>
    <table>
        <thead>
            <tr>
                <th class="pictureDeleteProduct">Pictures</th>
                <th>Name</th>
                <th>Price</th>
                <th class="commentPanelAdmin">Description</th>
                <th class="idCatPanelAdmin">Id catégorie</th>
                <th class="idCatPanelAdmin">Id sous catégorie</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

<?php
foreach($findProducts as $product){
    $url = explode(',', $product['url']);
    ?>

        <tr>
            <td class="pictureDeleteProduct"><img src="./uploads/<?= $url[0] ?>" alt="product" /></td>
            <td><span><?= $product['name'] ?></span></td>
            <td><span><?= $product['price'] ?> €</span></td>
            <td class="commentPanelAdmin"><span><?php echo substr($product['description'], 0, 80).'..' ?></span></td>
            <td class="idCatPanelAdmin"><span><?= $product['id_categorie'] ?></span></td>
            <td class="idCatPanelAdmin"><span><?= $product['id_sous_categorie'] ?></span></td>

            <td>
            <form method="post">
                <input type="hidden" name="idProduct" value="<?= $product['id'] ?>">
                <button type="submit" name="submitDelete">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </form>
            </td>
            
        </tr>

    <?php
}
?>
        </tbody>
    </table>
</section>