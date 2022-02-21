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
        $model = new BagsModel();
        $productAdded = $model
        ->setId_user(1)
        ->setId_product(1)
        ->setQuantity_product(1)
        ->setPrice_product(1);

        // $productAdded->create($model);
    }
}


?>