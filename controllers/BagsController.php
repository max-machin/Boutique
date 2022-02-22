<?php
require_once('libraries/Renderer.php');

class BagsController extends Controller
{
    // public function __construct()
    // {
    //     $model = new BagsModel();
         
    // }



    public static function insertBag()
    {
        if (isset($_POST['addBag']))
        {

        $model = new BagsModel();
        $productAdded = $model
        ->setId_user($_SESSION)
        ->setId_product($product->id)
        ->setQuantity_product($product->quantity_product);

        // $productAdded->create($model);  
        }

    }

    public static function showBag()
    {
        $model = new BagsModel();
        $model->find($_SESSION);
    }

    public static function deleteBag()
    {
        // $model = new BagsModel();
        // $model->delete($_SESSION);
    }

    public static function deleteFromBag()
    {
        $model = new BagsModel();
        // $model->deleteBy(['id_user'=> 1, 'id_product' => 7]);

    }

    //delete product from panier
    //moduler la quantité également de product from panier

}


?>