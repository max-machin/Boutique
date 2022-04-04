
<h1>Liste de nos produits</h1>
<?php 

$urlExplode = ProductsController::getUrlCategories();
// var_dump($urlExplode[2]);

?>
<nav>
    <ul>
    <?php foreach ($sousCategories as $sousCategorie) { ?>
            <li>
            <a href="<?=urlmac.'products/'.$urlExplode[1].'/'.$sousCategorie['name']?>"><?php echo $sousCategorie['name']; ?></a>
        </li>
            
    <?php } ?> 
        
    </ul>
</nav>

<?php 
// var_dump($_GET);

//get page pour pagination 

$urlSousCat = $_SERVER["REQUEST_URI"];
var_dump($_SERVER["REQUEST_URI"]);
// $urlSousCat = (parse_url($urlSousCat, PHP_URL_QUERY));
// // // print_r($urlSousCat);
// var_dump($urlSousCat);



// var_dump($nameCategorie); 
// var_dump($nameSousCategorie);


// if (in_array($urlExplode['sous_categorie'], $nameSousCategorie )){
//     echo 'testststst';
// ProductsController::createViewProducts($nameCategorie, $nameSousCategorie);

// }



// if(isset($_GET['submit']))
// {
//     $url = $_GET['p'];
//     echo $_GET[$url];
//     // var_dump($_GET); 
// }
// if(isset($_GET['sous_categorie']) && isset($_GET['submit']))
// {
    
//     ProductsController::productsBySousCategories($nameSousCategorie);
// }

//  }
    // var_dump($nameCategorie);
    // var_dump($nbrPages);
    // echo 'heloooo';
    // var_dump($_GET);
    // echo 'heloooo';

//   print_r($sousCategories);



    for ($i = 1; $i <= $nbrPages; $i++) {
        if ($page != $i)
            echo "<a class='page'href='?page=$i'>$i</a>";
        else
            echo "<a class='page'>$i</a>";
    }


//? pointer events: none sur css

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