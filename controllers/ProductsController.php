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

    public static function findAllProducts(){
        $model = new ProductsModel();
        $products = $model->findProductsforUpdate();
        Renderer::render('admin/updateProduct' , compact('products'));    
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

    public static function searchbarProduct()
    {
        if(isset($_POST['submit-search'])){
            $motclef = Controller::preventXSS($_POST['search']);

            $model = new ProductsModel;
            $searchedProducts = $model->searchProduct($motclef);
            Renderer::render('searchbar', compact('searchedProducts'));
            var_dump($searchedProducts);
         }   
    }

    public static function selectAllProductsCategory()
    {
        $model = new ProductsModel();
        $productsByCategories = $model->productsByCategorie();
        return $productsByCategories;
        // var_dump($_GET['categorie']);
        // var_dump($productsByCategories);
        

        // Renderer::render('products/allProducts' , [compact('productsByCategories')]);
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
    // }

    public static function getCategories()
    {
        $model = new CategoriesModel();
        $categories = $model->findAll();
        Renderer::render('layout' , compact('categories'));
        return $categories;
    }
    
    
    
    
    public static function pagination()
    {
        //     // $productByCat::paginationGenerale();
        
        //     // $catModel = new CategoriesModel();
        //     // $categories = $catModel->findAll();
        
        // var_dump('OK');
        // var_dump($_GET);
        // var_dump('OK');
        
        //     $productModel = new ProductsModel();
        //     $products = $productModel->findAll();
        //     // $productByCat = $model->getProductByCategorie();
        
        //     // var_dump($productByCat);
        //     // echo "</pre>";
        //     //  var_dump($productByCat);
        
        //     $page = $_GET["page"];

        $categories = self::getCategories();
       
        // if(isset($_GET['categorie']))
        // {
            
            // $page_categorie = 2;  
        // }
        // if (empty($page)) 
        // {
        //         $page = 1;
        // }
                    // $model = new ProductsModel();
                    // $count_products= $model->countProductsByCategories('makeup'); 
                    // $categories = $model->findAllCategories();
                
                
                
                
                //     $nbr_product_par_page = 3;
                //     $nbr_page = ceil($count_products[0]["liste"] / $nbr_product_par_page);
                //     $debut = ($page - 1) * $nbr_product_par_page;
                
                //     $productsByPage = $model->productsByPage($nbr_product_par_page, $debut);
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

    public static function getNameCategories()
    {
        $categories = self::getCategories();

        foreach ($categories as $categorie)
        {

        }
        
        echo "cateeeeee";
            
            //    $categorieNames[] = array();

        // for ($i = 0; $i <)
        // while ($categories = self::getCategories())
        // {
        //     $name = $categories['name'];

        //     $categorieNames[] = array("name" => $name);
        // }
        print_r($categorieNames);
        // 
        // Renderer::render('products/allProducts' , compact('categories', 'categorieName', 'categorie'));
        return $categories;
    }
    
    
                    
    public static function createViewProducts() 
    {
        
        $categorieName = self::getNameCategories();
        $categories = self::getCategories();
        // $sousCategories = self::selectAllSousCategory();
        $products = self::selectAllProducts();
        $productsByCategories = self::selectAllProductsCategory();
        $pagination = self::pagination();
        
        // var_dump($_GET['categorie']);
        if(isset($categorieName))
        {
            var_dump($categories);
            var_dump($categories);
           
        }
        // echo 'brrr';
            
        // echo 'brrr';
        // var_dump($categories[0]["name"]);
        
        
        $url = explode("/", filter_var($_GET['p'], FILTER_SANITIZE_URL));
        var_dump($url);
        if($url[1] !== $categories[0]['name']){

            echo "test operationnel";
            // if()

        }
        var_dump($categories);
        // var_dump($sousCategories);
        // var_dump($products);
        // var_dump($productsByCategories);
        Renderer::render('products/allProducts' , compact('categories', 'products', 'productsByCategories', 'sousCategories', 'page', 'categorieName'));
    }             
}
    
