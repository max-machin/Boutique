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

    public static function selectAllProductsCategory()
    {
        $categories = self::getCategories();
        $model = new ProductsModel();
        $productsByCategories = $model->findby($categories);

        return $productsByCategories;
       
    }

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

    // public static function productsByCategories()
    // {
    //     $model = new ProductsModel();
    //     $products_cat = $model->productsByCategorie();
    // }^

    public static function getCategories()
    {
        $model = new CategoriesModel();
        $categories = $model->findAll();
        $modelSousCat = new SousCategoriesModel();
        $sousCategories = $model->findAll();
        Renderer::render('layout' , compact('categories', 'sousCategories' ));
        // echo "<pre>";
        var_dump($categories);
        // echo "</pre>";
        
        return $categories;
    }
    
    public static function getCategorieName()
    {

        $products = new ProductsModel();
        $categories = self::getCategories();
        foreach ($categories as $categorie )
        {
            echo "get category NAME";
            var_dump($categorie['name']);

            // $categories[0]['name'] = $nameCategorie;
        }
          
        
        $url = explode("/", filter_var($_GET['p'], FILTER_SANITIZE_URL));
        var_dump($url);
        if($url[1] !== $categories[0]['name']){

            $categories['name'] = $nameCategorie;
            // $model = new ProductsModel();
            // $productByCat = $model->productsByCategorie($nameCategorie);
            // echo "bla bla";
            // var_dump($productsByCat);
            var_dump($nameCategorie);
        

        }
        return $nameCategorie;
    }
    
    public static function pagination()
    {
   
        
        
        //     $productModel = new ProductsModel();
        //     $products = $productModel->findAll();
        //     // $productByCat = $model->getProductByCategorie();
        
        //     // var_dump($productByCat);
        //     // echo "</pre>";
        //     //  var_dump($productByCat);
        
        //     $page = $_GET["page"];

        $nameCategorie = self::getCategorieName();
       
        // if(isset($_GET['categorie']))
        // {
            
            // $page_categorie = 2;  
        // }
        // if (empty($page)) 
        // {
        //         $page = 1;
        // }
                    $model = new ProductsModel();


                    $countProducts= $model->countProductsByCategories($nameCategorie); 
                    // $categories = $model->findAllCategories();
                
                    // var_dump('OK');
                    // var_dump($_GET);
                    // var_dump('OK');
                
                
                    $nbrProductsByPage = 1;
                    $nbrPages = ceil($countProducts[0]["liste"] / $nbrProductsByPage);
                //     $debut = ($page - 1) * $nbrProductsByPage;
                
                //     $productsByPage = $model->productsByPage($nbrProductsByPage, $debut);
                //     // $model->productsByPage($nbr_product_par_page, $debut);
                
                //     echo 'pagination';
                
                
                
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
        
        echo "1";
        $categories = self::getCategories();
        $$nameCategorie = self::getCategorieName();
        echo "1";
        $productsByCategories = self::selectAllProductsCategory();
        echo "1";
        // $sousCategories = self::selectAllSousCategory();
        // $products = self::selectAllProducts();
        $pagination = self::pagination();
      

        // }
        // var_dump($categories);
        // var_dump($sousCategories);
        // var_dump($products);
        // var_dump($productsByCategories);
        Renderer::render('products/allProducts' , compact('categories', 'products', 'productsByCat', 'sousCategories', 'productsByCategories', 'nameCategorie'));
    }
    
    public static function createMakeupView() 
    {

    }
}
    
//! faire une fonction pour make up et une func pour skincare avec deux renderer différents 