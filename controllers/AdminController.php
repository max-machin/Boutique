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
}