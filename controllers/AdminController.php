<?php
require_once('libraries/Renderer.php');


class AdminController extends Controller 
{
    public static function updateProduct(){
       $model = new ProductsModel();
       $updateProduit = $model
        ->SetId($_SESSION['product']['id'])
        ->SetName($_SESSION['product']['name'])
        ->setDescription($_SESSION['product']['description'])
        ->setPrice($_SESSION['product']['price']);
        var_dump($updateProduit);
        $updateProduit->update($model);

    }
   
}



?>