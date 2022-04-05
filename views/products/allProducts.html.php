
<h1>Liste de nos produits</h1>
<?php 

$urlExplode = ProductsController::getUrlCategories();
// var_dump($urlExplode[2]);

?>
<nav>
    <ul>
    <?php foreach ($sousCategories as $sousCategorie) { ?>
            <li>
            <a href="<?=urlmac.'products/'.$urlExplode[1].'/'.$sousCategorie['name'].'?page=1'?>"><?php echo $sousCategorie['name']; ?></a>
        </li>
            
    <?php } ?> 
        
    </ul>
</nav>

<?php 
// var_dump($_GET);

//get page pour pagination 

$urlSousCat = $_SERVER["REQUEST_URI"];
// var_dump($_SERVER["REQUEST_URI"]);
// $urlSousCat = (parse_url($urlSousCat, PHP_URL_QUERY));
// // // print_r($urlSousCat);
// var_dump($urlSousCat);



// var_dump($nbrProductsByPage); 
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

$var = explode('?', $_SERVER['REQUEST_URI']);
// echo'cccococo';
// var_dump(count($products));
var_dump($var);

$getCat = explode('/', $_SERVER['REQUEST_URI']);


 
$_GET['page'] = $var[1];

$page = $_GET['page'];

// echo'<pre>';
// var_dump($_GET);
// echo'</pre>';




//? pointer events: none sur css
// echo'<pre>';
// var_dump(intval($nbrPages));
// echo'</pre>';
$new_page = substr_replace($page, '', 0, 5);
// var_dump($new_page);
// var_dump(intval($new_page));

// if ($new_page = 0){
//      $new_page = 1; 

         
//         }
if(isset($products))
{
        for ($i = 1; $i <= intval($nbrPages); $i++) {
        
        echo "<a class='page'href='?page=$i'>$i</a>";
        
    } 
    
    for($i =intval($new_page) * (intval($new_page) - 1) ; $i < intval($nbrProductsByPage) * intval($new_page) && $i < count($products) ; $i++)    {
        $images = explode(',', $products[$i]['url']);
        // echo'fytdgd';
      
        {
            // foreach($products as $product){
                ?>
                <div class="products">
                    <h2><a href="products/<?= $products[$i]['id'] ?>"><?= $products[$i]['name'] ?></a></h2>
                    <img src="Uploads/<?= $image[$i] ?>" width="50px">
                    <h3><?= $products[$i]['description'] ?></h3>
                    <p><?= $products[$i]['price']?>€</p>
                </div>
            <?php
            // }
        }
        /*
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
                <h2><a href="products/<?= $products[$i]['id'] ?>"><?= $products[$i]['name'] ?></a></h2>
                <h3><?= $products[$i]['description'] ?></h3>
                <p><?= $products[$i]['price'] ?></p>
            </div>
            <?php
            */
    }
}

// else



?>