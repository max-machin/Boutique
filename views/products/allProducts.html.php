
<h1>Liste de nos produits</h1>

<form action="" method="GET">
    <select name="sous_categorie">
        <?php foreach ($sousCategories as $sousCategorie) { ?>
            <option value="<?php echo $sousCategorie['name']; ?> "><?php echo $sousCategorie['name']; ?> </option>
            
        <?php } ?> 
    </select>
    <input type='hidden' name='page' value='1'>
    <button type='submit' name="submit" class="formButton">Valider</button>
</form>

<?php 
var_dump($_GET['sous_categorie']);

if(isset($_GET['sous_categorie']) && isset($_GET['submit']))
{
    
    ProductsController::productsBySousCategories($nameSousCategorie);
}

//  }
    // var_dump($nameCategorie);
    // var_dump($nbrPages);
    // echo 'heloooo';
    // var_dump($_GET);
    // echo 'heloooo';

//   print_r($sousCategories);

// if (isset($nameCategorie)) {
    
//  $page_categorie = $nameCategorie;




// }

// for ($i=0;$i<count($products);$i++)
// {
//     echo $products[$i];
// }
// var_dump($products[$i]);

// foreach ($products as $product) {
//     var_dump($product);
// }

// else {
    for ($i = 1; $i <= $nbrPages; $i++) {
        if ($page != $i)
            echo "<a class='page'href='?page=$i'>$i</a>";
        else
            echo "<a class='page'>$i</a>";
    }
// }


if(isset($products))
{

    foreach($products as $product)
    {
        // var_dump($product);
        $images = explode(',', $product['url']);
        // var_dump($images);
        
    ?>

            <div class="products">
                <?php
                    foreach($images as $image){

                        // var_dump($image);
                        ?>
                        <img src="Uploads/<?= $image ?>" width="50px">
                        <?php
                    }
                ?>
                <h2><a href="products/<?= $product['id'] ?>"><?= $product['name'] ?></a></h2>
                <h3><?= $product['description'] ?></h3>
                <p><?= $product['price'] ?></p>
            </div>
    <?php
    }
}
else
{
    foreach($products as $product){
        ?>
        <div class="products">
            <h2><a href="products/<?= $product['id'] ?>"><?= $product['name'] ?></a></h2>
            <h3><?= $product['description'] ?></h3>
            <p><?= $product['price']?>€</p>
        </div>
    <?php
    }
}

?>