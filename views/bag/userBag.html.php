<section class="bag">
    <h1 class="sous-titre">My bag</h1>
    <?php

    // Si l'utilisateur est connecté
    if ( isset ( $_SESSION['user_data']))
    {
        // Initialisation de la quantité et du prix du panier
        $bagQuantity = 0; 
        $bagPrice = 0;
        // Si des produits avec / sans COULEUR sont ajouté en panier
        if ( !empty ( $bagProductsColors) || !empty ($bagProducts))
        {
            // Affichage des produits possédant une couleur
            foreach($bagProductsColors as $bagProduct)
            {
                $model = new BagsModel();
                $images = $model->findImages($_SESSION['user_data']['id'], $bagProduct['id']);
                $imagesColor = explode(',', $images[0]['url_image']);
                
                // Calcul du prix total d'un produit = Prix unitaire * quantité
                $productsPrice = $bagProduct['price'] * $bagProduct['quantity_product'];

                // Calcul du prix du panier 
                $bagPrice += $productsPrice;
                
                // Calcul de la quantité
                $bagQuantity += $bagProduct['quantity_product'];
            
            ?>

            <article class="bagProduct">   
                    <form action="" method="post">
                        <div class="flex productbag">
                            <button class="# delete1" type="submit" name="deleteFromBagColors">&#x2715</button>
                            <img src="<?= url ?>Uploads/<?= $imagesColor[0] ?>" alt="">

                            <div class="inbag">
                                <div class="flex intproductbag">
                                    <p><a  href="<?= url ?>products/<?= $bagProduct['id'] ?>"><?= $bagProduct['name'] ?></a></p>
                                    <label class="color" for="<?= $bagProduct['color_name'] ?>" style="background-color: #<?= $bagProduct['code'] ?>">
                                            
                                    </label>
                                </div>
                                <div class="flex intproductbag">
                                    
                                    <select name="quantityColors" id="">
                                        <option value="<?= $bagProduct['quantity_product']?>" selected > x<?= $bagProduct['quantity_product']?></option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                    <input type="hidden" name="id_color" value="<?= $bagProduct['id_color'] ?>">
                                    <input type="hidden" name="idProductColors" value=" <?= $bagProduct['id'] ?>">
                                    <input type="submit" name="submitQuantityColors" value="⟳">
                                    <input type="hidden" name="idProductColors" value="<?= $bagProduct['id'] ?>"/>
                                    <button class="# delete2" type="submit" name="deleteFromBagColors">&#x2715</button>           
                                    
                                
                                    <div class="bagprice">
                                        <p> <?= $bagProduct['price'] ?>€</p>
                                        <h4><?= $productsPrice ?>€</h4>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </form>
            </article>
        
            <?php
            } 
            foreach ($bagProducts as $product)
            {
                $model = new BagsModel();
                $images = $model->findImages($_SESSION['user_data']['id'], $product['id']);
                
                $image = explode(',', $images[0]['url_image']);
                // Calcul du prix total d'un produit = Prix unitaire * quantité
                $productsPrice = $product['price'] * $product['quantity_product'];

                // Calcul du prix du panier 
                $bagPrice += $productsPrice;
                
                $bagQuantity += $product['quantity_product'];
        
            ?>

            <article class="bagProduct">
                    
                    
                    <form action="" method="post">
                        <div class="flex productbag">
                            <button class="# delete1" type="submit" name="deleteFromBag">&#x2715</button>
                            <img src="<?= url ?>Uploads/<?= $image[0] ?>" alt="">
                            <div class="inbag">
                                <div class="flex intproductbag">
                                    <p><a href="products/<?= $product['id'] ?>"><?= $product['name'] ?></a></p>
                                    <label class="color"></label>
                                </div>

                                <div class="flex intproductbag">
                                    
                                    <select name="quantity" id="">
                                    <option value="<?= $product['quantity_product']?>" selected > x<?= $product['quantity_product']?></option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                    <input type="hidden" name="idProduct" value=" <?= $product['id'] ?>">
                                    <input type="submit" name="submitQuantity" value="⟳">

                                    <input type="hidden" name="idProduct" value="<?= $product['id'] ?>"/>           
                                    <button class="# delete2" type="submit" name="deleteFromBag">&#x2715</button>
                                    <div>
                                        <p> <?= $product['price'] ?>€</p>
                                        <h4><?= $productsPrice ?>€</h4>  
                                    </div>
                                    
                                </div>
                            </div>
                            
                        </div>
                    </form>
            </article>
            
            <?php
            } 
            ?>
            <article class="flex bagPrice">
                <div>
                    <p>Subtotal :</p>
                    <p>(<?= $bagQuantity ?> articles)</p>
                </div>
                <div>
                    <p class="price"><?= $bagPrice ?>€</p>
                </div>
            </article>
            
            <form action="" method="post">
                <input class="submit submitbag" type="submit" name="command" value="Passez commande">
            </form>

        <?php
        } 
            else 
        {
        ?>

        <article class="emptyBagcontainer">
            <img src="images/generalvibe/collection1(1).jpeg" alt="" height="270px">
            <div>
                <h3>Because beauty has no price..</h3>
                <p>Free delivery from 50€</p>
                <a href="products"><button class="submit">I take it</button></a>
                <p class="help">Offer applicable only for the French territory*</p>
            </div>
        </article>

        <article class="emptyBag txt-center">
            <i class="fa-solid fa-tag"></i>
            <p>Your bag is empty</p>
            <a href="products"><button class="submit">Start shopping</button></a>
        </article>
        <?php
        }
    } else {
        header("Location: users/login");
    }

    ?>
</section>

