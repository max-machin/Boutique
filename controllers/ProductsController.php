<?php
require_once('libraries/Renderer.php');

class ProductsController extends Controller
{  

    // public function __construct(){

    // }
    
    public static function seeProduct()
    {
        $model = new ProductsModel();
        $product = $model->find($id);
        return $product;
        Renderer::render('products/seeProduct' , compact('product'));
    }
    
   

    public static function selectAllProducts()
    {
        
        $model = new ProductsModel();
        $products = $model->selectAllProducts(); 
        foreach($products as $product){
            $images = explode(',', $product->url); 
         }      
        Renderer::render('products/allProducts' , compact('products', 'product', 'images'));    
    }

    public static function selectAll()
    {
        $model = new ProductsModel();
        $products = $model->findAll();
        Renderer::render('admin/uploadImage' , compact('products'));    
        return $products;
        // var_dump($products);

        // Renderer::render('products/allProducts' , compact('products'));
       
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

    public static function selectAllSousCategory()
    {
        $model = new ProductsModel();
        $soloproduct = $model->selectProductbyId($id);
        foreach($soloproduct as $product){
            $images = explode(',', $product->url); 
         }  
        Renderer::render('products/seeProduct' , compact('product', 'images'));
    }

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

        // $sousCategories = $model->findAllSousCategories();

        // return $sousCategories;
        // echo '<pre>';
        // var_dump($sousCategories);
        // echo '</pre>';
        // Renderer::render('products/allProducts' , compact('sousCategories'));

    
    
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
        $model = new ProductsModel();
        $categories = $model->findAllCategories();
        return  $categories;
        // var_dump($categories);
        // Renderer::render('products/allProducts' , compact('categories'));
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
            echo $categorie;

        }
        $categorieName = array();
        while ($categories = self::getCategories()){
            $name = $categories['name'];
        }
        echo "cateeeeee";
        var_dump($categorieName);
        // Renderer::render('products/allProducts' , compact('categories', 'categorieName', 'categorie'));
        return $categorieName;
    }
    
                    
    public static function createViewProducts() 
    {
        
        $categorieName = self::getCategorieName();
        $categories = self::getCategories();
        $sousCategories = self::selectAllSousCategory();
        $products = self::selectAllProducts();
        $productsByCategories = self::selectAllProductsCategory();
        $pagination = self::pagination();
        
        // var_dump($_GET['categorie']);
        if(isset($categories))
        {
            var_dump($categories);
            var_dump($categories["name"]);
        }
        echo 'brrr';
            
        echo 'brrr';
        var_dump($categories[0]["name"]);
        
        
        $url = explode("/", filter_var($_GET['p'], FILTER_SANITIZE_URL));
        // var_dump($url[1]);
        
        if($url[1] !== $categories['name']){

            echo "test operationnel";
            // if()

        }
        // var_dump($categories);
        // var_dump($sousCategories);
        // var_dump($products);
        // var_dump($productsByCategories);
        Renderer::render('products/allProducts' , compact('categories', 'products', 'productsByCategories', 'sousCategories', 'page'));
    }             
}
    
