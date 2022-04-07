<?php

require_once('libraries/Renderer.php');

class ProductsController extends Controller
{  

    public static function allProducts()
    {
        
        // var_dump($_GET);
        $url = explode("/", $_GET['p']);
        var_dump($url);

        //Affichage de tout les produits car par de paramètres 'categorie' en url
        if (!isset($url[1]))
        {
            $model = new ProductsModel();
            $findAllProducts = $model->findAllProducts();
            Renderer::render('products/allProducts', compact('findAllProducts', 'url'));
        }

        //Affichage de tous les produits trié par categorie
        if (isset($url[1])){
            $model = new CategoriesModel();
            $findCategories = $model->findAll();

            
            foreach ($findCategories as $categories)
            {
                if ($url[1] == $categories['name'])
                {
                    $model = new ProductsModel();
                    $findProductByCategorie = $model->findByCat($categories['id']);

                    $model = new CategoriesModel();
                    $findCat = $model->findBy(['id' => $categories['id']]);
                    
                    $souscat = new SousCategoriesModel();
                    $findSousCategories = $souscat->findBy(['id_categorie' => $categories['id']]);

                }
                
            }
            
            if (isset($url[2]))
            {
                
                $model = new SousCategoriesModel();
                $sousCategories = $model->findBy(['name' => $url[2]]);
                
                $model = new ProductsModel();
                $findProductBySousCategorie = $model->findBySsCat(['id_sous_categorie' => $sousCategories[0]['id']]);
                // var_dump($findProductBySousCategorie);

            Renderer::render("products/allProducts", compact('url', 'sousCategories', 'findProductBySousCategorie'));
            }
            
            Renderer::render("products/allProducts", compact('findProductByCategorie','findSousCategories','findCat', 'url'));
        }
        
    }

    public static function categorieProducts($categorie)
    {
        Renderer::render('products/allProducts/skincare', compact('findCategories'));
    }

    public static function selectAll(){
        $model = new ProductsModel();
        $products = $model->findAll();
        Renderer::render('admin/uploadImage' , compact('products'));    
    }

    public static function findAllProducts(){
        $model = new ProductsModel();
        $products = $model->findProductsforUpdate();
        Renderer::render('admin/updateProduct' , compact('products'));    
    }

    /**
     * Fonction affichage du produit seul, contenant également tout le traitement de l'ajout panier selon
     * quantité, couleur, possibilité également d'ajouter le produit en favoris, affichage des commentaires relatif au produit.
     *
     * @param [type] $id
     * @return void
     */
    public static function seeProduct($id){

        $findUser = "";
        $error_color = "";

        $model = new ProductsModel();
        $soloproduct = $model->selectProductbyId($id);

        foreach($soloproduct as $product){
            $images = explode(',', $product['url']); 
         }  

         // Récupération des couleurs selon l'id du produit
        $model = new ColorsModel();
        $findColors = $model->findBy(['id_product' => $id]);

        // Récupération du produit selon son id
        $productModel = new ProductsModel();
        $product = $productModel->find($id);

        // Si le produit n'est pas connu en base de données on redirige vers la liste des produits
        if (empty($product))
        {
            header('location: ../products');
        }

        // Ajout d'un produit au panier
        if ( isset ( $_POST['addBag']))
        {
            $user = new BagsModel();
            $findUser = $user->findBy(['id_user' => $_SESSION['user_data']['id']]);

            /**
             * AJOUT D'UN PRODUIT AU PANIER AVEC COULEUR
             */
            // Si l'article posséde des couleurs
            if ( !empty($findColors))
            {
                if ( isset($_POST['color']))
                {
                    // Si l'utilisateur n'a pas de panier
                    if (empty ($findUser)) 
                    {
                        $color = intval($_POST['color']);
                        // On ajoute un produit au panier
                        $model = new BagsModel(); 
                        $productAdded = $model
                            ->setId_user($_SESSION['user_data']['id'])
                            ->setId_product($_POST['id_Product'])
                            ->setId_color($color)
                            ->setQuantity_product($_POST['product_quantity']);
                        $productAdded->create($model);  

                        
                        $findModel = new BagsModel();
                        $find = $findModel->findBy(['id_product' => $_POST['id_Product']]);


                        // Si le produit n'est pas dans le panier alors on le créer et on l'insert
                        if ( empty ($find) )
                        {
                
                            $color = intval($_POST['color']);

                            $model = new BagsModel();
                            $productAdded = $model
                            ->setId_user($_SESSION['user_data']['id'])
                            ->setId_product($_POST['id_Product'])
                            ->setQuantity_product($_POST['product_quantity'])
                            ->setId_color($color);
                            $productAdded->create($model);  

                        // Sinon on update sa quantité
                        } else {
                            
                            $model = new BagsModel();
                            $updateBag = $model->updateQuantityColors($_POST['product_quantity'], $_POST['id_Product'], $_SESSION['user_data']['id'], $_POST['color']);
                        }
                    // Si l'utilisateur a déjà un panier
                    } else {

                        $findModel = new BagsModel();
                        $find = $findModel->findBy(['id_product' => $_POST['id_Product'], 'id_user' => $_SESSION['user_data']['id'], 'id_color' => $_POST['color']]);
                        // Si le produite n'existe pas dans le panier on l'insert
                        if ( empty ($find) )
                        {
                            $color = intval($_POST['color']);

                            $model = new BagsModel();
                            $productAdded = $model
                            ->setId_user($_SESSION['user_data']['id'])
                            ->setId_product($_POST['id_Product'])
                            ->setQuantity_product($_POST['product_quantity'])
                            ->setId_color($color);
                            $productAdded->create($model);  

                        // Sinon on l'update
                        } else {

                        $model = new BagsModel();
                        $updateBag = $model->updateQuantityColors($_POST['product_quantity'], $_POST['id_Product'], $_SESSION['user_data']['id'], $_POST['color']);
                        }
                    }
                } 
                else 
                {
                    $error_color = "Veuillez sélectionner une couleur";
                } 
            } 
            /**
             * AJOUT D'UN PRODUIT AU PANIER SANS COULEUR
             */
            else 
            {
                // Si l'utilisateur n'a pas de panier
                if (empty ($findUser))
                {
                    // On ajoute un panier au produit
                    $model = new BagsModel();
                    $productAdded = $model
                        ->setId_user($_SESSION['user_data']['id'])
                        ->setId_product($_POST['id_Product'])
                        ->setQuantity_product($_POST['product_quantity']);
                    $productAdded->create($model);  

                    
                    $findModel = new BagsModel();
                    $find = $findModel->findBy(['id_product' => $_POST['id_Product']]);

                    // Si le produit n'est pas dans le panier alors on le créer et on l'insert
                    if ( empty ($find) )
                    {
                       
                        var_dump($find);
                        $model = new BagsModel();
                        $productAdded = $model
                        ->setId_user($_SESSION['user_data']['id'])
                        ->setId_product($_POST['id_Product'])
                        ->setQuantity_product($_POST['product_quantity']);
                        
                        $productAdded->create($model);  

                    // Sinon on update sa quantité
                    } else {
                        

                        $model = new BagsModel();
                        $updateBag = $model->updateQuantity($_POST['product_quantity'],$_POST['id_Product'], $_SESSION['user_data']['id']);
                        
                    }
                // Si l'utilisateur a déjà un panier
                } else {

                    $findModel = new BagsModel();
                    $find = $findModel->findBy(['id_product' => $_POST['id_Product'], 'id_user' => $_SESSION['user_data']['id']]);
                    // Si le produite n'existe pas dans le panier on l'insert
                    if ( empty ($find) )
                    {
                        $model = new BagsModel();
                        $productAdded = $model
                        ->setId_user($_SESSION['user_data']['id'])
                        ->setId_product($_POST['id_Product'])
                        ->setQuantity_product($_POST['product_quantity']);
                        $productAdded->create($model);  

                    // Sinon on l'update
                    } else {
                    $model = new BagsModel();
                    $updateBag = $model->updateQuantity($_POST['product_quantity'], $_POST['id_Product'], $_SESSION['user_data']['id']);
                    
                    }
                }
            
            }

        }

        /**
         * AJOUT EN FAVORIS D'UN PRODUIT
         */
        // Si l'utilisateur est connecté
        if ( isset ( $_SESSION['user_data']))
        {
            // Action sur le bouton ajout/suppression favoris
            if ( isset ( $_POST['addFav']))
            {
    
            
            $fav = new FavorisModel();
            $findFav = $fav->findFavoris( $_SESSION['user_data']['id'],$id);
                
                // Si le produit est en favoris ( connu en base de données selon l'id de l'user)
                if ( !empty ( $findFav))
                {
                    $delete = new FavorisModel();
                    $deleteFavoris = $delete->deleteBy(['id_product' => $_POST['id_Product'], 'id_user' => $_SESSION['user_data']['id']]);
                // Si le produit n'est pas en favoris ( inconnu en base de données)on l'ajoute
                } elseif ($findFav == null) {
                    $favoris = new FavorisModel();
                    $addFav = $favoris
                        ->setId_user($_SESSION['user_data']['id'])
                        ->setId_product($_POST['id_Product'])
                        ->setFav(1);
                    $addFav->create($favoris);
                    
                }
            }
        
        // Requête de vérification d'existence du produit en favoris pour l'user
        $fav = new FavorisModel();
        $findFav = $fav->findFavoris( $_SESSION['user_data']['id'],$id); 
 
        // Requête pour l'affichage du bouton add/delete favoris en fonction du résultat
        $find = new FavorisModel();
        $favoritFind = $find->findFavorisUser($_SESSION['user_data']['id'],$id);

        }

        /**
         * AFFICHAGE DES COMMENTAIRES DU PRODUIT
         */
        $commentModel = new CommentsModel();
        $allComments = $commentModel->productComment($id);

        $errorComment = "";

        if ( isset ($_POST['addComment']))
        {
            if ( !empty ($_POST['comment']))
            {
                $model = new CommentsModel();
                $comment = $_POST['comment'];

                $comment = $model
                    ->setId_product($_POST['id_product'])
                    ->setId_user( $_SESSION['user_data']['id'])
                    ->setComment( $comment )
                    ->setDate(date('Y-m-d H:i:s'))
                    ->setNote($_POST['star']);
                $comment->create($model);
                header('refresh: 0');

            } else {
                $errorComment = "Veuillez remplir le champ";
            }
        }

         /**
         * AFFICHAGE DES PRODUITS EN COMMUN
         */
        $model = new ProductsModel();
        $findRelated = $model->findRelatedproduct($product['id_categorie'], $id);
        


        if ( isset ($_SESSION['user_data']))
        {
            Renderer::render('products/seeProduct' , compact('product', 'images', 'allComments', 'errorComment', 'findUser', 'findColors', 'error_color', 'findFav', 'favoritFind', 'findRelated'));
        } else {
            Renderer::render('products/seeProduct' , compact('product', 'images', 'allComments', 'errorComment', 'findUser', 'findColors', 'findRelated'));
        }
        
    }

    public static function searchbarProduct()
    {
        if(isset($_POST['submit-search'])){
            $motclef = Controller::preventXSS($_POST['search']);

            $model = new ProductsModel;
            $searchedProducts = $model->searchProduct($motclef); 
            Renderer::render('searchbar', compact('searchedProducts'));
         }   
    }


    public static function seeUpdateProduct($id)
    {
        // var_dump($id);
        $model = new ProductsModel();
        $product = $model->find(2);
        var_dump($product);
        Renderer::render('products/updateProduct' , compact('product'));
        // Renderer::render('products/updateProduct' , compact('product'));
    }

    public static function updateProduct()
    {
        $model = new ProductsModel();
        $updateProduit = $model
         ->SetId($_SESSION['product']['id'])
         ->SetName($_SESSION['product']['name'])
         ->setDescription($_SESSION['product']['description'])
         ->setPrice($_SESSION['product']['price']);
         $updateProduit->update($model);
 
     }

    public static function createProduct()
    {
        $model = new ProductsModel();
        $product = $model
            ->setId_sous_categorie($_SESSION['subcategory']['id'])
            ->setId_categorie($_SESSION['category']['id'])
            ->setPrice($_POST['price'])
            ->setDescription($_POST['description'])
            ->setName($_POST['name']);
        $product->create($model); 
    }
    
    public static function deleteProduct(){
        // $model = new ProductsModel();
        // var_dump($product = $model->delete((3)));
        
    }
    public static function getCategories()
    {
        $model = new CategoriesModel();
        $categories = $model->findAll();
      
        return $categories;
    }

    

    // public static function getSousCategories($cat) 
    // {
    //     $modelSousCat = new SousCategoriesModel();
    //     $sousCategories = $modelSousCat->findSousCategories($cat);

    //     return $sousCategories;
    // }
    
    // public static function getCategorieName()
    // {
    //     $categories = self::getCategories();

    //     // var_dump($categories);
    //     // echo 'je suis dans getcatename';

    //     $nameCategorie = [];

    //     foreach ($categories as $categorie )
    //     {
    
    //         array_push($nameCategorie, $categorie['name']);
    //     }
      
    //     return $nameCategorie;
    // }

    // public static function getSousCategorieName($cat)
    // {
    //     $sousCategories = self::getSousCategories($cat);

    //     $nameSousCategorie = [];

    //     foreach ($sousCategories as $sousCategorie )
    //     {
    
    //         array_push($nameSousCategorie, $sousCategorie['name']);
    //     }
    //     //  var_dump($nameSousCategorie);
    //     return $nameSousCategorie;
    // }


    // public static function productsByCategories($nameCategorie)
    // {
    //     $model = new ProductsModel();
    //     $productsCat = $model->productsByCategorie($nameCategorie);

    //     var_dump($productsCat);

    //     return $productsCat;

    // }

    // public static function productsBySousCategories($nameCategorie)
    // {
    //     $model = new ProductsModel();
    //     $productsSousCat = $model->productsBySousCategories($nameCategorie);

    //     return $productsSousCat;

    // }

    // public static function getUrl($qry)
    // {
    //         $result = array();
     
    //          if(strpos($qry,'?')!==false) {
    //            $q = parse_url($qry);
    //            $qry = $q['query'];
    //           }
    //         else {
    //                 return false;
    //         }

    //         foreach (explode('&', $qry) as $couple) {
    //                 list ($key, $val) = explode('=', $couple);
    //                 $result[$key] = $val;
    //         }

    //         return $result;
    // }

    
    // public static function getUrlCategories()
    // {

    //     $categorieUrl = self::getCategorieName();

    //     $url = explode("/", filter_var($_GET['p'], FILTER_SANITIZE_URL));
    //     // var_dump($url);
    //     return $url;
        
    // }


    // //pagination va prendre en paramètre des countsrproducts all , cat et sous cat. Il va également recevoir en paramètre le resultat de la requete select...
    // public static function paginationSousCat()
    // {
    //     $model = new ProductsModel();
    //     $sousCat = self::getUrlCategories();

    //     $products = $model->productsBySousCategories(@$sousCat[2]);

    //     $countProductsSousCat = count($products);

    //     $page = null;
    //     if($page === 0){

    //         $page === 1;
    //     }
       
    //     $nbrProductsByPage = 2;
    //     $nbrPagesSousCat = ceil($countProductsSousCat / $nbrProductsByPage);
       
    //     return array ($page, $nbrProductsByPage, $nbrPagesSousCat, $countProductsSousCat);
        
    // }
    
    // public static function paginationCat()
    // {
    //     $model = new ProductsModel();
    //     $catUrl = self::getUrlCategories();

       
    //     $productsCat = $model->productsByCategorie($catUrl[1]);

    //     $countProductsCat = count($productsCat);

    //     $page = null;
    //     if($page === 0){

    //         $page === 1;
    //     }
       
    //     $nbrProductsByPage = 2;
    //     $nbrPagesCat = ceil($countProductsCat / $nbrProductsByPage);
     
      
    //     return array ($page, $nbrProductsByPage, $nbrPagesCat, $countProductsCat);
        
    // }
           
    // public static function createViewProducts($cat = null, $sousCat = null) 
    // {
    //     $model = new ProductsModel();
    //     $categories = self::getCategories();
    //     $nameCategorie = self::getCategorieName();
    //     $pagination = self::paginationCat();
    //     $paginationSousCat = self::paginationSousCat();
    //     $nameSousCategorie = self::getSousCategorieName($cat);
    //     $recupSousCat = self::getUrlCategories();
    //     $sousCategories = self::getSousCategories($cat);
        
    //     $sousCat = @$recupSousCat[2];
    //     $cat = @$recupSousCat[1];
     
    //     $page = $pagination[0];
    //     $nbrProductsByPage = $pagination[1];
    //     $nbrPagesCat = $pagination[2];
    //     $nbrPagesSousCat = $paginationSousCat[2];
       
    //     $countProductsCat = $pagination[3];
    //     $countProductsSousCat = $paginationSousCat[3];
        
       
    //     if (!empty($sousCat) ) {
            
    //         $products = self::productsBySousCategories($sousCat);
    //         $pagination = self::paginationSousCat();
    //         $nameSousCategorie = self::getSousCategorieName($cat);
    //         $sousCategories = self::getSousCategories($cat);
            
    //     } 
    //     else if (!empty($cat)) {
    //         $products = self::productsByCategories($cat);
    //         $pagination = self::paginationCat();
    //         $nameCategorie = self::getCategorieName();
    //         $categories = self::getCategories();
    //     } 
        
       
    //     Renderer::render('products/catProducts' , compact('categories','nameCategorie', 'nbrPagesCat','nbrPagesSousCat', 'sousCategories', 'products', 'nameSousCategorie', 'page','nbrProductsByPage','countProductsCat', 'countProductsSousCat'));
       
    // }

    // public static function productsAll()
    // {
    //     $products = self::selectAllProducts();

    //     Renderer::render('products/allProducts' , compact('products'));
    // }
    
    
}
    
