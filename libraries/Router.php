<?php

class Router 
{
    public static function process() {
        // ce qu'on va inclure comme fichier en fonction des différentes actions de l'utilisateur
        if(!empty($_GET['p'])){
        // le filter va filtrer ce qu'on a dans le get afin donc de sécuriser, le nom du filtre suit
            $url = explode('/', filter_var($_GET['p'], FILTER_SANITIZE_URL));
            var_dump($_GET['p']);
            
            //ucfirst = première lettre en maj
            $controller = ucfirst($url[0]);
            // echo $controller;
            $controllerName = $controller."Controller";
            var_dump($controllerName);
            // $controllerFile = "controllers/".$controllerName.".php";

            //le router va définir quelle page il va inclure selon l'action de l'utilisateur càd, si l'utilisateur va chercher accueil -> à travers toutes les transformations d'en-haut, le controller choisi sera ControllerAccueil.php
            //si tu n'instancie pas ton objet, ton autoload ne trouvera pas dans quelle classe aller. En effet, l'autoload va dans application, c'est application qui va trouver selon l'url le controller (et donc l'autoload trouve ainsi sa classe puisqu'ils ont le même nom) ET la task qu'on lui demande grâce à l'url ici de dire hello
            

            if (!empty($url[1])){
                if ( $controllerName == "UsersController"){
                    $controllerName::register();
                }
            }
            elseif ($controllerName == "UsersController") {
                
                $controllerName::selectAllUsers();
                $controllerName::selectUser();
                $controllerName::updateUser();
                $controllerName::deleteUser();
                // $controllerName::find();
            }


        
            if(!empty($url[1])){
                if($controllerName == "ProductsController"){
                $controllerName::seeProduct($url[1]);
                }
            }elseif($controllerName == "ProductsController"){
                 $controllerName::selectAllProducts();
                }
            

            if($url[1] == 'delete'){
            if ($controllerName == "BagsController") {
                $controllerName::showBag();
                $controllerName::deleteFromBag();
                }
            }elseif ($controllerName == "BagsController"){
                $controllerName::showBag();
                $controllerName::quantityBag(); 
            }

                  

                
            if ($controllerName == "CommentsController")
            {
                $controllerName::insert();
            }   

        }      

    }   
}

     



