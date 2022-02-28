<?php

class ProductsController extends Controller
{  
    public static function selectAllProducts(){
        echo 'je suis dans selectall';
        $model = new ProductsModel();
        $products = $model->findAll();
        Renderer::render('products/allProducts' , compact('products'));
    }

    public static function seeProduct($id){
        $model = new ProductsModel();
        $product = $model->find($id);
        Renderer::render('products/seeProduct' , compact('product'));
    }

    public static function seeUpdateProduct($id){
        // var_dump($id);
        $model = new ProductsModel();
        $product = $model->find($id);
        Renderer::render('products/updateProduct' , compact('product'));
    }

    public static function updateProduct(){
        $model = new ProductsModel();
        $updateProduit = $model
         ->SetId($_SESSION['product']['id'])
         ->SetName($_SESSION['product']['name'])
         ->setDescription($_SESSION['product']['description'])
         ->setPrice($_SESSION['product']['price']);
        //  var_dump($updateProduit);
         $updateProduit->update($model);
 
     }

    public static function createProduct(){
        $model = new ProductsModel();
        $product = $model
            ->setId_sous_categories('Max')
            ->setId_categories('Max')
            ->setPrice('Max')
            ->setDescription('Max')
            ->setName('Max')
            ->setId('Max');
        Renderer::render('admin/addProduct' , compact('product'));
    }
}