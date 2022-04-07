<?php
require_once('libraries/Renderer.php');

class BagsController extends Controller
{ 
    /**
     * Fonction Show Bag : Fonction permettant l'affichage du panier de l'utilisateur, ainsi que la modification
     * de la quantité produit
     *
     * @return void
     */
    public static function showBag()
    {
        $error_color = "" ;
        $findColors = "";

        // Affichage du bags user
        // Récuperation des produits avec couleur
        $model = new BagsModel();
        $bagProductsColors = $model->checkBagColors($_SESSION['user_data']['id']);

        foreach ($bagProductsColors as $table){
            $model = new BagsModel();
            $imagesColors = $model->findImages($_SESSION['user_data']['id'], $table['id']);
        }

        // Boucle pour récupérer les couleurs des produits 
        foreach($bagProductsColors as $product)
        {
            $model = new ColorsModel();
            $findColors = $model->findBy(['id_product' => $product['id']]);
        }

        // Récupération des produits sans couleurs
        $bagModel = new BagsModel();
        $bagProducts = $bagModel->checkBag($_SESSION['user_data']['id']);

        foreach ($bagProducts as $table){
            $model = new BagsModel();
            $images = $model->findImages($_SESSION['user_data']['id'], $table['id']);
            var_dump($images);
        }
            
        // Update de la quantité produit avec COULEUR
        if ( isset ( $_POST['submitQuantityColors']))
        {
            $bag = new BagsModel();
            $updateBag = $bag->updateQuantityColors($_POST['quantityColors'], $_POST['idProductColors'], $_SESSION['user_data']['id'], $_POST['id_color']);
            header('refresh: 0');
        } 
        // Suppression d'un produit en panier avec COULEUR
        elseif ( isset ( $_POST['deleteFromBagColors']))
        {
            $id_product = $_POST['idProductColors'];
            $model = new BagsModel();
            $deleteBag = $model->deleteBy(['id_product' => $id_product, 'id_user' => $_SESSION['user_data']['id'], 'id_color' => $_POST['id_color']]);
            header('refresh: 0'); 
            echo "Produit supprimé avec succés";
        } 
        // Update de la quantité produit sans COULEUR
        elseif ( isset ($_POST['submitQuantity']))
        {
            $bag = new BagsModel();
            $updateBag = $bag->updateQuantity($_POST['quantity'], $_POST['idProduct'], $_SESSION['user_data']['id']);
            header('refresh: 0');
        }
        // Suppression d'un produit en panier sans COULEUR
        elseif( isset ($_POST['deleteFromBag']))
        {
            $id_product = $_POST['idProduct'];
            $model = new BagsModel();
            $deleteBag = $model->deleteBy(['id_product' => $id_product, 'id_user' => $_SESSION['user_data']['id']]);
            header('refresh: 0');
            echo "Produit supprimé avec succés";
        }
        

        // Validation du panier pour passer commande
        elseif ( isset ( $_POST['command']))
        {
            header('location: users/commands');
        }

        if ( isset ($imagesColors)){
            Renderer::render('bag/userBag', compact('bagProductsColors','bagProducts', 'findColors', 'imagesColors'));
        }
        if ( isset ($images)){
            Renderer::render('bag/userBag', compact('bagProductsColors','bagProducts', 'findColors','images'));
        }
        if ( isset($images) || isset($imagesColors)) {
            Renderer::render('bag/userBag', compact('bagProductsColors','bagProducts', 'findColors', 'imagesColors','images')); 
        } else {
            Renderer::render('bag/userBag', compact('bagProductsColors','bagProducts', 'findColors'));
        }
        
    }
}


?>