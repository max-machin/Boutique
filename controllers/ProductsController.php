<?php

class ProductsController extends Controller
{  
    public static function selectAllProducts(){
        $model = new ProductsModel();
        $products = $model->findAll();
        Renderer::render('products/selectAllproducts' , compact('products'));
    }

    public static function seeProduct($id){
        $model = new ProductsModel();
        $product = $model->find($id);
        // Renderer::render('products/seeProduct' , compact('product'));
    }

    public static function createProduct(){
        $model = new ProductsModel();
        $product = $model
            ->setId_sous_sategories('Max')
            ->setId_categories('Max')
            ->setPrice('Max')
            ->setDescription('Max')
            ->setName('Max')
            ->setId_products('Max');
        // Renderer::render('products/seeProduct' , compact('product'));
    }

    public static function deleteProduct(){
        $model = new ProductsModel();
        var_dump($product = $model->delete((3)));
        
    }


}