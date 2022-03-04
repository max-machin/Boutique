<?php
require_once('libraries/Renderer.php');

class BagsController extends Controller
{

    public static function showBag()
    {

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
        @$model->deleteBy(['id_user'=> $_SESSION['user_data']['id'], 'id_product' => $_SESSION['bag']['id_product']]);

    }

    public static function quantityBag()
    {
        $quantity = new BagsModel();
        @$quantity -> updateQuantity(1, $_SESSION['bag']['id_product'], $_SESSION['bag']['quantity']);
        var_dump($quantity);
    }

}


?>