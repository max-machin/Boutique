<?php
require_once('libraries/Renderer.php');

class ProductsController extends Controller
{  
    public static function selectAllProducts(){
        $model = new ProductsModel();
        $products = $model->findAll();
        Renderer::render('products/allProducts' , compact('products'));
        // $model = new ProductsModel();
        // $categories = $model->findAllCategories();
        // Renderer::render('products/allProducts' , compact('products', 'categories'));
    }
    
    public static function seeProduct($id){
        $model = new ProductsModel();
        $product = $model->find($id);
        Renderer::render('products/seeProduct' , compact('product'));
    }
    
    public static function createProduct(){
        $model = new ProductsModel();
        $product = $model
        ->setId_sous_sategories('Max')
        ->setId_categories('Max')
        ->setPrice('Max')
        ->setDescription('Max')
        ->setName('Max')
        ->setId('Max');
        // Renderer::render('products/seeProduct' , compact('product'));
    }
    
    public static function deleteProduct(){
        $model = new ProductsModel();
        var_dump($product = $model->delete((3)));
        
    }
    
    // public static function pagination()
    // {
        
        
    //     $page = "";
    //     if(isset($_GET['page']))
    //     {
    //         $page = $_GET["page"];
    //     }
    //     if(isset($_GET['categorie']))
    //     {
    //         $page_categorie = $_GET['categorie'];  
            
    //     }
    //     if (empty($page)) {
    //         $page = 1;
    //     }
    //     $model = new ProductsModel();
    //     $count_products= $model->countProducts(); 
    //     $categories = $model->findAllCategories();
        
    //     echo 'test';
    //     var_dump($count_products);
    //     echo 'test';

        
    //     $nbr_product_par_page = 3;
    //     $nbr_page = ceil($count_products[0]["liste"] / $nbr_product_par_page);
    //     $debut = ($page - 1) * $nbr_product_par_page;
        
    //     $products = $model->productsByPage($nbr_product_par_page, $debut);
    //     // $model->productsByPage($nbr_product_par_page, $debut);

    //     // echo 'pagination';

    //     if(isset($_GET['categorie']))
    //     {

    //         $sous_categorie = $model->productsBySousCategories($page_categorie,$debut_cat);

    //         $page_categorie = $_GET['categorie']; 
            
    //         $nbr_product_par_page = 3;
    //         $nbr_page_cat = ceil($count_products[0]["liste"] / $nbr_product_par_page);
    //         $debut_cat = ($page - 1) * $nbr_product_par_page;
            
    //     }

        
    //     Renderer::render('products/allProducts' , compact('products', 'categories', 'count_products', 'nbr_page', 'page'  ));
    // }

    // public static function calculPage()
    // {
        
    //     $nbr_product_par_page = 3;
    //     $nbr_page = ceil($count_products[0]["liste"] / $nbr_product_par_page);
    //     $debut = ($page - 1) * $nbr_product_par_page;
       
    // }
    

}