<?php

require_once('libraries/Renderer.php');

class ProductsController extends Controller
{  
    public $NameCategorie;
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
        // echo "<pre>";
        // var_dump($categories);
        // echo "</pre>";
        
        return $categories;
    }

    public static function getSousCategories() 
    {
        $modelSousCat = new SousCategoriesModel();
        $sousCategories = $modelSousCat->findAll();

        // echo "<pre>";
        // var_dump($sousCategories);
        // echo "</pre>";
        // Renderer::render('layout' , compact('sousCategories' ));

        return $sousCategories;
    }
    
    public static function getCategorieName()
    {

        // $products = new CategoriesModel();
        $categories = self::getCategories();
        // foreach ($categories as $categorie )
        // {
    
        //     $nameCategorie = $categorie['name'];
           
        // }
          echo "<pre>";
        var_dump($nameCategorie);
        echo "</pre>";
        return $nameCategorie;
    }

    public static function productsByCategories()
    {
        $model = new ProductsModel();
        $productsCat = $model->productsByCategorie();

    }

    
    public static function getUrlCategories()
    {

        $categorieUrl = self::getCategorieName();

        $url = explode("/", filter_var($_GET['p'], FILTER_SANITIZE_URL));
        // var_dump($url);
        if($url[1] === $categorieUrl){


            // $model = new ProductsModel();
            // $productByCat = $model->productsByCategorie();
            echo "bla bla";
            // var_dump($productsByCat);
            // var_dump($nameCategorie);
        }

        
      
    }
    
    public static function pagination()
    {
   
        
      
        $model = new ProductsModel();
        $countProducts= $model->countProducts();
        $products= $model->productsByCategorie();
        $categorieUrl = self::getUrlCategories();
        $nameCategorie = self::getCategorieName();
        // var_dump($categorieUrl);
        // if(isset())
        // {
            
        //     $page_categorie = 2;  
        // }
        // if (empty($page)) 
        // {
        //         $page = 1;
        // }
                  
            
                
                
                    $nbrProductsByPage = 1;
                    $nbrPages = ceil($countProducts[0]["liste"] / $nbrProductsByPage);
                    // var_dump($countProducts[0]["liste"]) ;
                //     $debut = ($page - 1) * $nbrProductsByPage;
                
                //     $productsByPage = $model->productsByPage($nbrProductsByPage, $debut);
                //     // $model->productsByPage($nbr_product_par_page, $debut);
              
            return [$products, $nbrPages,];
 
                
                
                
                //     if(isset($_GET['categorie']))
                //     {
                    
                    //         $sous_categorie = $model->productsBySousCategories($page_categorie,$debut_cat);
                    
                    //         //  
                    
                    //         $nbr_product_par_page = 3;
                    //         $nbr_page_cat = ceil($count_products[0]["liste"] / $nbr_product_par_page);
                    //         $debut_cat = ($page - 1) * $nbr_product_par_page;
                    
                    //     }
                    
                    
                    //     Renderer::render('products/allProducts' , compact('products', 'categories', 'count_products', 'nbr_page', 'page', 'page_categorie'  ));
                    // }
                    
                    // public static function calculPage()
                    // {
                        
                        //     $nbr_product_par_page = 3;
                        //     $nbr_page = ceil($count_products[0]["liste"] / $nbr_product_par_page);
                        //     $debut = ($page - 1) * $nbr_product_par_page;
                        
    }

    
    
                    
    public static function createViewProducts() 
    {
        // echo "1";
        $categories = self::getCategories();
        $sousCategories = self::getSousCategories();
        $nameCategorie = self::getCategorieName();
        $categorieUrl = self::getUrlCategories();
        // echo "1";
        // $productsByCategories = self::selectAllProductsCategory();
        // echo "1";
        // $sousCategories = self::selectAllSousCategory();
        // $products = self::selectAllProducts();
        $pagination = self::pagination();
        
        $products = $pagination[0];
        $nbrPages = $pagination[1];

        // var_dump($products);
       
        Renderer::render('products/allProducts' , compact('categories', 'categorieUrl','nameCategorie', 'products', 'nbrPages', 'sousCategories'));
        // Renderer::render('products/allProducts' , compact('categories', 'products', 'countProducts', 'productsByCat', 'sousCategories', 'productsByCategories', 'categorieUrl','nameCategorie', 
        // 'nbrPages'));
    }
    
    public static function createMakeupView() 
    {

    }
}
    
//! faire une fonction pour make up et une func pour skincare avec deux renderer différents 