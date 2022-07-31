<?php
require_once('libraries/Renderer.php');

class AdminController extends Controller
{
    public static function dashBoardAdmin()
    {
        $users = new UsersModel();
        $findUsers = $users->countAll();

        $products = new ProductsModel();
        $findProducts = $products->countAll();

        $prix = new CommandsModel();
        $chiffreAffaire = $prix->chiffreAffaire();

        $command = new CommandsModel();
        $nbrCommand = $command->nbrCommand();

        $nbr = new CommandsModel();
        $nbrProduit = $nbr->countAll();

        $best = new CommandsModel();
        $bestSellers = $best->findBestSeller();
        
        Renderer::render('admin/backoffice', compact('findUsers', 'findProducts', 'chiffreAffaire', 'nbrCommand', 'nbrProduit', 'bestSellers'));
    }

    public static function findAllProdAdmin(){
        $products = new ProductsModel();
        $findProducts = $products->findAllProducts();


        if (isset($_POST['submitDelete'])){
            $targetimage = new ImagesModel();
            $deleteImages = $targetimage->deleteBy(['id_product' => $_POST['idProduct']]);
            $targetProduct = new ProductsModel();
            $deleteTargetProduct = $targetProduct->deleteBy(['id' => $_POST['idProduct']]);

            header('refresh: 0');
        }

        Renderer::render('admin/deleteProduct', compact('findProducts'));
    }

    public static function findAllUsers(){

        $users = new UsersModel();
        $findUsers = $users->findAll();

        if(isset($_POST['deleteUser'])){

            $comment = new Commentsmodel();
            $deleteComment = $comment->deleteBy(['id_user' => $_POST['idUser']]);


            $user = new UsersModel();
            $deleteUser = $user->deleteBy(['id' => $_POST['idUser']]);
            header('refresh: 0');
        }

        Renderer::render('admin/manageUser', compact('findUsers'));
    }

    public static function findAllComments(){

        $comments = new CommentsModel();

        $findComments = $comments->findCommentsByProduct();

        if(isset($_POST['deleteComment'])){

            $comment = new Commentsmodel();
            $deleteComment = $comment->deleteBy(['id' => $_POST['idComment']]);

            header('refresh: 0');
        }

        Renderer::render('admin/manageComments', compact('findComments'));
    }
}