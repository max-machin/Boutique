<?php
require_once('libraries/Renderer.php');

class CommandsController extends Controller
{  
    public static function selectBestsellers(){
        $model = new CommandsModel();   
        $bestsellers = $model->findBestsellers();
        Renderer::render('accueil' , compact('bestsellers'));    
    }

}

?>