<?php

class ProductsController extends Controller
{  
    public static function selectAllProducts(){
        $model = new ProductsModel();
        $products = $model->findAll();
        Renderer::render('products/AllProducts' , compact('products'));
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
    
    public static function pagination()
    {
        $model = new ProductsModel();
        $count_products= $model->productsByCategories();
        $page = "";
        if(isset($_GET['page']))
        {
            $page = $_GET["page"];
        }
        
        if (empty($page)) {
            $page = 1;
        }
        $nbr_product_par_page = 5;
        $nbr_page = ceil($count_products[0]["liste"] / $nbr_product_par_page);
        $debut = ($page - 1) * $nbr_product_par_page;
        
        $products = $model->productsByPage($nbr_product_par_page, $debut);

       
       
        if (count($products) == 0) {
            header("location: products.php");
        }

        if(isset($_GET['categorie']))
        {
            $page_categorie = $_GET['categorie'];
        }

        Renderer::render('products/AllProducts' , compact('products'));
    }
    

}