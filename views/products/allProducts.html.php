
<h1>Liste de nos produits</h1>
<?php 

$urlExplode = ProductsController::getUrlCategories();
// var_dump($categories);

$var = explode('?', $_SERVER['REQUEST_URI']);


$getCat = explode('/', $_SERVER['REQUEST_URI']);
// var_dump($var);


 
$_GET['page'] = $var[1];

$page = $_GET['page'];

// echo'<pre>';
// var_dump($getCat);
// echo'</pre>';

$pageEnCours = '?page=1';

/*
?>
<nav>
    <ul>
    <?php
        if(isset($getCat[3]) && !isset($getCat[4])){
            foreach ($categories as $categorie) { 
    ?>
        <li>
            <a href="<?=urlmac.'products/'.$categorie['name'].$pageEnCours?>"><?php echo $categorie['name']; ?></a>
        </li>
            
    <?php 
        } 
    } 
    ?> 
           
    </ul>
    <?php
            if(isset($getCat[4])){
    ?>
        <ul>
     foreach ($sousCategories as $sousCategorie) { ?>
        <li>
            <a href="<?=urlmac.'products/'.$urlExplode[1].'/'.$sousCategorie['name'].'?page=1'?>"><?php echo $sousCategorie['name']; ?></a>
        </li>
            
    <?php } ?> 
            }
        
    
   
        
    </ul>
</nav>
*/
// ?>
<nav>
   
   
            <!-- // if(isset($getCat[4])){ -->
   
        <ul>
            <?php
     foreach ($sousCategories as $sousCategorie) { ?>
        <li>
            <a href="<?=urlmac.'products/'.$urlExplode[1].'/'.$sousCategorie['name'].'?page=1'?>"><?php echo $sousCategorie['name']; ?></a>
        </li>
            
    <?php } ?> 
       
    </ul>
</nav>

<?php 


$urlSousCat = $_SERVER["REQUEST_URI"];



//? pointer events: none sur css

$new_page = substr_replace($page, '', 0, 5);

if(isset($getCat[2]))
{
        for ($i = 1; $i <= intval($nbrPages); $i++) {
        
        echo "<a class='page'href='?page=$i'>$i</a>";
        
    } 
    
    for($i =intval($new_page) * (intval($new_page) - 1) ; $i < intval($nbrProductsByPage) * intval($new_page) && $i < count($products) ; $i++)    {
        $images = explode(',', $products[$i]['url']);
   
      var_dump($products[$i]['url']);
        {
                ?>
                <div class="products">
                    <h2><a href="products/<?= $products[$i]['id'] ?>"><?= $products[$i]['name'] ?></a></h2>
                    <img src="Uploads/<?= $image[$i] ?>" width="50px">
                    <h3><?= $products[$i]['description'] ?></h3>
                    <p><?= $products[$i]['price']?>€</p>
                </div>
            <?php
           
        }
    
    }
    
}




?>