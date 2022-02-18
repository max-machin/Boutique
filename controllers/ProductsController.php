<?php

class ProductsController extends Controller
{  
    public static function selectAllProducts(){
        $model = new ProductsModel();
        $products = $model->findAll();
        Renderer::render('allProducts' , compact('products'));
    }

    public static function seeProduct($id){
        $model = new ProductsModel();
        $product = $model->find($id);
        Renderer::render('seeProduct' , compact('product'));
    }
}