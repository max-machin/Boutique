<article class='seeproduct'>
    <?php

    //si admin
    if($_SESSION['user_data']['id'] == 1)
    { 
        //les images
        foreach($images as $image){
        ?>     
            <img src="uploads/<?= $image ?>" width="50px">
        <?php
            }
        ?>

        <h1><?= $product['name'] ?></h1>

        <form action="<?= $product['id'] ?>/update" method="post">  
            <input type="hidden" name="id" value="<?= $product['id'] ?>"/>          
            <button class="addBag" type="submit" name="updateProduct">Update</button>
        </form>
    <?php

    } 
    //sinon le user
    else
    { 
        ?>
        <!-- le slide -->
        <div class='slider'>
            <?php
            //les images
                foreach($images as $image){
                ?>         
                    <img src="uploads/<?= $image ?>" width="50px" class = "img_slider">
                <?php
                }
            ?> 
        
                <img src="images/utilitaires/previous.svg" id="previous">
                <img src="images/utilitaires/next.svg" id="next"> 
        </div>                 
        <section class='text-product'>
            <div class='titre_product'>
                <h1><?= $product['name'] ?></h1>
                <!-- le coeur favoris -->
                    <?php
                        if( isset($findFav) && $favoritFind == true )
                        {
                        ?>  
                        <form action="" method="post">
                            <input type="hidden" value="<?= $product['id']?>" name="id_Product">
                            <button class="fav outfav" type="submit" name="addFav">
                                <img src="images/utilitaires/heart_fill.png" alt="" width="20px">
                            </button>
                        </form>
                        <?php
                        } elseif ( $favoritFind == false ) {   
                        ?>
                        <form action="" method="post">
                            <input type="hidden" value="<?= $product['id']?>" name="id_Product">
                            <button class="fav infav" type="submit" name="addFav">
                                <img src="images/utilitaires/heart_empty.png" alt="" width="20px">
                            </button>
                        </form>
                        <?php
                        }
                    ?>
            </div>
                        
            <!-- description du produit -->
            <p><?= $product['description'] ?></p>

            <!-- si l'utilisateur est là -->
            <?php
            if ( isset ( $_SESSION['user_data']))
            {
            ?>
                <form action="" method="post">  

                    <!-- couleurs -->
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
                            echo "<div class='error-msg'><p>$error_color</p></div>";
                        ?>
                    </div>
                    <p class="priceProduct"><?= $product['price'] ?> €</p>
                    <!-- quantité du produit -->
                    <div class="add_quantity">
                       
                        <select name="product_quantity" id="product_quantity">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                            
                        <!-- add bouton -->
                        <input type="hidden" name="id_Product" value="<?= $product['id'] ?>">
                        <button class="addBag" type="submit" name="addBag">Add</button>                        
                    </div>
                </form>
            <?php
            } 

            // sinon si pas de user
            else 
            {
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

            <!-- commentaires pour users -->
        <section class="sectionComments"> 
            <?php
                foreach ( $allComments as $comment)
                {
            ?>
                <div class="comments">
                    <?php
                    $i = 0;
                    while ( $i < $comment['note']){
                    ?>
                        <label for="">★</label>

                    <?php
                    $i++;
                    }
                    ?>
                    <p><?= $comment['comment'] ?></p>
                    <p class="info_commentaire">Posté par : <?= $comment['prenom'] ?> le : <?= $comment['datefr'] ?> à <?= $comment['heurefr'] ?></p>
                </div>
            <?php
                }
                // si il y a user alors il peut poster un commentaire et noter le produit
                    if ( isset ( $_SESSION['user_data']))
                {    
            ?>
                <div class='post_comment'>
                    <form action="" method="post">
                        <!-- notation du produit -->
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

                        <textarea name="comment" id="comment" cols="20" rows="3" placeholder="Add a comment"></textarea><br>
                        <input type="hidden" value="<?= $product['id'] ?>" name="id_product">
                        <?= $errorComment ?><br>

                        <input type="submit" name="addComment" id="addComment" value="Add a comment">
                    </form>
                </div>

            </section>
            
            <?php
            } 
            // sinon il faut se connecter
            else
             {
            ?>
                <p>Veuillez vous <a href="users/register">inscrire</a> / <a href="users/login">connectez</a> pour ajouter un commentaire</p>
            <?php 
            }
        }
        ?>
        </section>

</article>
    <h2 class="txt-center titre_related">Complétez votre look</h2>
            <section class="wrapper relatedProduct">
                    <?php
                    
                        foreach ( $findRelated as $product)
                        {
                            $images = new ImagesModel();
                            $findImages = $images->relatedImages($product['id_product']);
                            ?>
                    <div class="bestsellers-products">
                        
                        <div class="bestsellers-img">
                            <img src="uploads/<?= $findImages['url_image'] ?>" >
                        </div>
                            <div class='intern-case'>
                                <h3><?= $product['product_name'] ?></h3>
                                <p class="txt-center"><?= $product['prix'] ?> €</p>
                                <a href='products/<?= $product['id_product'] ?>'><button>VOIR</button></a>                     
                            </div>
                          
                    </div>
                            <?php
                        }
                    ?>
            </section>
       
<script type="text/javascript" src="views/products/js/script.js"></script>
         
