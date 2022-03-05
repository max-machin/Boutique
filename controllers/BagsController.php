<?php
require_once('libraries/Renderer.php');

class BagsController extends Controller
{ 

    public static function showBag()
    {
        // Affichage du bags user
        // Création du model Bags
        $model = new BagsModel();

        // Requête permettant l'affichage des données du panier
        $bagProducts = $model->checkBag($_SESSION['user_data']['id']);

        if ( isset ( $_POST['submitQuantity']))
        {
            $bag = new BagsModel();
            $updateBag = $bag->updateQuantity($_POST['quantity'], $_POST['idProduct'], $_SESSION['user_data']['id']);
            header('refresh: 0');
        } 
        elseif ( isset ( $_POST['deleteFromBag']))
        {
            $id_product = $_POST['idProduct'];
            $model = new BagsModel();
            $deleteBag = $model->deleteBy(['id_product' => $id_product, 'id_user' => $_SESSION['user_data']['id']]);
            header('refresh: 0');
            echo "Produit supprimé avec succés";
        }
        elseif ( isset ( $_POST['command']))
        {
            header('location: users/commands');
        }

        Renderer::render('bag/userBag', compact('bagProducts'));
    }

    public static function deleteBag()
    {
        // $model = new BagsModel();
        // $model->delete($_SESSION);
    }

}


?>