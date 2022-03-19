<section class="bag txt-center">
    <h1 class="sous-titre">Mon panier</h1>
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
                $imagesColor = explode(',', $imagesColors['url_image']);
                
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
                            <img src="<?= url ?>Uploads/<?= $imagesColor[0] ?>" alt="" width="120px" height="150px">

                            <div>
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
                                    <button class="#" type="submit" name="deleteFromBagColors">&#x2715</button>
                                
                                    <div>
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
                $images = explode(',', $images['url_image']);
                // Calcul du prix total d'un produit = Prix unitaire * quantité
                $productsPrice = $product['price'] * $product['quantity_product'];

                // Calcul du prix du panier 
                $bagPrice += $productsPrice;
                
                $bagQuantity += $product['quantity_product'];
        
            ?>

            <article class="bagProduct">
                    
                    
                    <form action="" method="post">
                        <div class="flex productbag">
                       
                            <img src="<?= url ?>Uploads/<?= $images[0] ?>" alt="" width="120px" height="150px" >
                            <div>
                                <div class="flex intproductbag">
                                    <p><a href="<?= url ?>products/<?= $product['id'] ?>"><?= $product['name'] ?></a></p>
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
                                    <button class="#" type="submit" name="deleteFromBag">&#x2715</button>
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
                    <p>Sous-total :</p>
                    <p>(<?= $bagQuantity ?> articles)</p>
                </div>
                <div>
                    <p class="price"><?= $bagPrice ?>€</p>
                </div>
            </article>
            
            <form action="" method="post">
                <input class="submit" type="submit" name="command" value="Passez commande">
            </form>

        <?php
        } 
            else 
        {
        ?>
            <p>Votre panier est vide</p>

        <?php
        }
    } else {
        header("Location: users/login");
    }

    ?>
</section>

