<?php
require_once('libraries/Renderer.php');

class BagsController extends Controller
{

    public static function insertBag()
    {

        $model = new BagsModel();
        $productAdded = $model
        ->setId_user($_SESSION['user']['id'])
        ->setId_product($_SESSION['product']['id'])
        ->setQuantity_product($product->quantity_product);

        // $productAdded->create($model);  
        
    }

    public static function showBag()
    {

        // inner join
        $model = new BagsModel();
        $bagProducts = $model->checkBag(1);
        // var_dump($bagProducts);
        Renderer::render('bag/userBag', compact('bagProducts'));
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


    //moduler la quantité également de product from panier

}


?>