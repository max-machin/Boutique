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

    public static function createProduct(){
        $model = new ProductsModel();
        $product = $model
            ->setId_sous_sategories('Max')
            ->setId_categories('Max')
            ->setPrice('Max')
            ->setDescription('Max')
            ->setName('Max')
<<<<<<< HEAD
            ->setId('Max');
=======
            ->setId_products('Max');
>>>>>>> 410b512db276e1338c62252524554d86ac0bf5a9
    }
}