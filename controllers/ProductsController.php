<?php

require_once('libraries/Renderer.php');

class ProductsController extends Controller
{  
    
    public static function selectAllProducts(){

        $model = new ProductsModel();
        $products = $model->findAllProducts(); 
        // foreach($products as $product){
        //     $images = explode(',', $product->url); 
        //  }      
         Renderer::render('products/allProducts' , compact('products'));    
    }

    public static function selectAll(){
        $model = new ProductsModel();
        $products = $model->findAll();
        Renderer::render('admin/uploadImage' , compact('products'));    
    }

    public static function seeProduct($id){
        $model = new ProductsModel();
        $soloproduct = $model->selectProductbyId($id);
        foreach($soloproduct as $product){
            $images = explode(',', $product['url']); 
         }  

        $productModel = new ProductsModel();
        $product = $productModel->find($id);

        if ( empty($product))
        {
            header('location: ../products');
        }

        if ( isset ($_POST['addBag']))
        {
        $model = new BagsModel();
        $productAdded = $model
        ->setId_user($id_user)
        ->setId_product($id_product)
        ->setQuantity_product($quantity);

        // $productAdded->create($model);  
        }

        $commentModel = new CommentsModel();
        $allComments = $commentModel->productComment($id);

        $errorComment = "";

        if ( isset ($_POST['addComment']))
        {
            if ( !empty ($_POST['comment']))
            {
                $model = new CommentsModel();
                $comment = valid_data($_POST['comment']);

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
        Renderer::render('products/seeProduct' , compact('product', 'images', 'allComments', 'errorComment'));
    }

    // public static function selectAllProductsCategory()
    // {
    //     $categories = self::getCategories();
    //     $model = new ProductsModel();
    //     $productsByCategories = $model->findby($categories);

    //     return $productsByCategories;
       
    // }

    // public static function selectAllSousCategory()
    // {
    //     $model = new ProductsModel();
    //     $soloproduct = $model->findBy($id);
    //     foreach($soloproduct as $product){
    //         $images = explode(',', $product->url); 
    //      }  
    //     Renderer::render('products/seeProduct' , compact('product', 'images'));
    // }

    public static function seeUpdateProduct($id)
    {
        // var_dump($id);
        $model = new ProductsModel();
        $product = $model->find($id);
        Renderer::render('products/updateProduct' , compact('product'));
    }

    public static function updateProduct()
    {
        $model = new ProductsModel();
        $updateProduit = $model
         ->SetId($_SESSION['product']['id'])
         ->SetName($_SESSION['product']['name'])
         ->setDescription($_SESSION['product']['description'])
         ->setPrice($_SESSION['product']['price']);
        //  var_dump($updateProduit);
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

    public static function getSousCategories($cat) 
    {
        $modelSousCat = new SousCategoriesModel();
        $sousCategories = $modelSousCat->findSousCategories($cat);

        return $sousCategories;
    }
    
    public static function getCategorieName()
    {
        $categories = self::getCategories();

        $nameCategorie = [];

        foreach ($categories as $categorie )
        {
    
            array_push($nameCategorie, $categorie['name']);
        }
      
        return $nameCategorie;
    }

    public static function getSousCategorieName($cat)
    {
        $sousCategories = self::getSousCategories($cat);

        $nameSousCategorie = [];

        foreach ($sousCategories as $sousCategorie )
        {
    
            array_push($nameSousCategorie, $sousCategorie['name']);
        }
        //  var_dump($nameSousCategorie);
        return $nameSousCategorie;
    }


    public static function productsByCategories($nameCategorie)
    {
        $model = new ProductsModel();
        $productsCat = $model->productsByCategorie($nameCategorie);

        return $productsCat;

    }

    
    // public static function getUrlCategories()
    // {

    //     $categorieUrl = self::getCategorieName();

    //     $url = explode("/", filter_var($_GET['p'], FILTER_SANITIZE_URL));
    //     // var_dump($url);
    //     // if($url[1] === $categorieUrl){
    //     // }

        
      
    // }

    //pagination va prendre en paramètre des countsrproducts all , cat et sous cat. Il va également recevoir en paramètre le resultat de la requete select...
    public static function pagination()
    {
        $model = new ProductsModel();
        $countProducts = $model->countProducts();

        $page = 1;
        $nbrProductsByPage = 1;
        $nbrPages = ceil($countProducts[0]["liste"] / $nbrProductsByPage);
        $debut = ($page - 1) * $nbrProductsByPage;

        var_dump($nbrPages);

        return array ($page, $nbrProductsByPage, $nbrPages, $debut);
       
    }
    
    
     //paramètre $cat et sous cat viennent de l'url                
    public static function createViewProducts($cat = null, $sousCat = null) 
    {



        $model = new ProductsModel();
        $countProducts= $model->countProducts();
        $categories = self::getCategories();
        $nameCategorie = self::getCategorieName();
        $pagination = self::pagination();
        
        $page = $pagination[0];
        $nbrProductsByPage = $pagination[1];
        $nbrPages = $pagination[2];
        $debut = $pagination[3];
      var_dump($_GET);
        
        //3 fonction pour les produits
        if ($sousCat != null) {
            
           
            echo 'bla';
            $products = self::productsBySouscat($sousCat);
            // $nbrProductsByPage = 1;
            // $nbrPages = ceil($countProducts[0]["liste"] / $nbrProductsByPage);
        } else if ($cat != null) {
            
            $nameSousCategorie = self::getSousCategorieName($cat);
            $sousCategories = self::getSousCategories($cat);
            $products = self::productsByCategories($cat);
        } else {

            $products = self::allProducts();
        }

        
       
        Renderer::render('products/allProducts' , compact('categories','nameCategorie', 'nbrPages', 'sousCategories', 'products', 'nameSousCategorie', 'debut', 'page'));
        // Renderer::render('products/allProducts' , compact('categories', 'products', 'countProducts', 'productsByCat', 'sousCategories', 'productsByCategories', 'categorieUrl','nameCategorie', 
        // 'nbrPages'));
    }
    
    public static function createMakeupView() 
    {

    }
}
    
//! faire une fonction pour make up et une func pour skincare avec deux renderer différents 