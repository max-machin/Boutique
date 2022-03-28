<?php
/*require_once('libraries/Renderer.php');*/
?>

<article class='seeproduct'>
    <?php

    if(@$_SERVER['user_data']['id'] == 1)
    { 
        echo 'salut';
            foreach($images as $image){
        ?>
                
            <img src="<?= "http://localhost:8080/Boutique/uploads/" ?>" width="50px">
        <?php
            }
        ?>

        <h1><?= $product['name'] ?></h1>

        <form action="<?= $product['id'] ?>/update" method="post">  
            <input type="hidden" name="id" value="<?= $product['id'] ?>"/>          
            <button class="#" type="submit" name="updateProduct">Update</button>
        </form>
    <?php

    } 
    else
    {
        ?>
        <div class='slider'>
            <?php
                foreach($images as $image){

                ?>         
                    <img src="http://localhost:8080/Boutique/uploads/<?= $image ?>" width="50px">
                <?php
                }
            ?> 
            <button>previous</button>
            <button>next</button>  
        </div>
        
        <section class='text-product'>

        <div class='titre_product'>
           <h1><?= $product['name'] ?></h1>

            <?php
                if( isset($findFav) && $favoritFind == true )
                {
                ?>
                    
                    <button class="fav outfav" type="submit" name="addFav">
                        <img src="images/utilitaires/heart_fill.png" alt="" width="20px">
                    </button>

                <?php
                } elseif ( $favoritFind == false ) {
                    
                ?>
                    
                    <button class="fav infav" type="submit" name="addFav">
                        <img src="<?= urlLaura ?>images/utilitaires/heart_empty.png" alt="" width="20px">
                    </button>
                <?php
                }
            ?>
        </div>
 
            <p><?= $product['description'] ?></p>


            <?php
            if ( isset ( $_SESSION['user_data']))
            {
                
            ?>
                <form action="" method="post">  

                    <div class="product_color">

                        <?php
                            foreach( $findColors as $color)
                            {
                        ?>
                            <label class="color" for="<?= $color['name'] ?>" style="background-color: #<?= $color['code'] ?>">
                                <input id="<?= $color['name'] ?>" type="radio" name="color" value="<?= $color['id'] ?>">
                            </label>
                        <?php
                            } 
                            echo $error_color;
                        ?>
                    </div>

                    

                    <select name="product_quantity" id="product_quantity">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>

                    
                    <input type="hidden" name="id_Product" value="<?= $product['id'] ?>">
                    <button class="#" type="submit" name="addBag">Add</button>

                </form>
            <?php
            } else {
            ?>
                <article class="product_color">

            <?php
                    foreach( $findColors as $color)
                    {
            ?>
                    <label class="color" for="<?= $color['name'] ?>" style="background-color: #<?= $color['code'] ?>">
                        
                    </label>
            <?php
                    } 
            ?>
                </article>
            <?php
            }
            ?>
        <section class="sectionComments"> 
            
            <?php
                foreach ( $allComments as $comment)
                {
            ?>
                <article>
                    <p>Posté par : <?= $comment['prenom'] ?> le : <?= $comment['datefr'] ?> à <?= $comment['heurefr'] ?></p>
                    <p><?= $comment['comment'] ?></p>

                    <?php
                    $i = 0;
                    while ( $i < $comment['note']){
                    ?>
                        <label for="">★</label>

                    <?php
                    $i++;
                    }
                    ?>

                </article>
            <?php
                }
                    if ( isset ( $_SESSION['user_data']))
                {    
            ?>

            <form action="" method="post">
                
                <textarea name="comment" id="comment" cols="30" rows="10" placeholder="Add a comment"></textarea><br>
                <input type="hidden" value="<?= $product['id'] ?>" name="id_product">
                <?= $errorComment ?><br>

                <span>Notez le produit</span>
                <div class="rating">
                    <input id="star5" name="star" type="radio" value="5" class="radio-btn hide" />
                    <label for="star5" >☆</label>
                    <input id="star4" name="star" type="radio" value="4" class="radio-btn hide" />
                    <label for="star4" >☆</label>
                    <input id="star3" name="star" type="radio" value="3" class="radio-btn hide" />
                    <label for="star3" >☆</label>
                    <input id="star2" name="star" type="radio" value="2" class="radio-btn hide" />
                    <label for="star2" >☆</label>
                    <input id="star1" name="star" type="radio" value="1" class="radio-btn hide" />
                    <label for="star1" >☆</label>
                </div>

                <input type="submit" name="addComment" id="addComment" value="Comment">
            </form>
            </section>
            <?php
            } else {
            ?>
                <p>Veuillez vous <a href="<?= urlLaura ?>users/register">inscrire</a> / <a href="<?= urlLaura ?>users/login">connectez</a> pour ajouter un commentaire</p>
            <?php 
            }
        }
        ?>
        </section>

</article>
       
         
