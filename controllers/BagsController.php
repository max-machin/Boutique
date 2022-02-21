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
        ->setId_product(uc)
        ->setQuantity_product(uc);

        // $productAdded->create($model);  
        }

    }


}


?>