<?php

class Router 
{
    public static function process() 
    {
        // ce qu'on va inclure comme fichier en fonction des différentes actions de l'utilisateur
        if(!empty($_GET['p']))
        {
        // le filter va filtrer ce qu'on a dans le get afin donc de sécuriser, le nom du filtre suit
            $url = explode('/', filter_var($_GET['p'], FILTER_SANITIZE_URL));
            
            //ucfirst = première lettre en maj
            $controller = ucfirst($url[0]);
            // echo $controller;
            $controllerName = $controller."Controller";
            // $controllerFile = "controllers/".$controllerName.".php";
            //le router va définir quelle page il va inclure selon l'action de l'utilisateur càd, si l'utilisateur va chercher accueil -> à travers toutes les transformations d'en-haut, le controller choisi sera ControllerAccueil.php
            //si tu n'instancie pas ton objet, ton autoload ne trouvera pas dans quelle classe aller. En effet, l'autoload va dans application, c'est application qui va trouver selon l'url le controller (et donc l'autoload trouve ainsi sa classe puisqu'ils ont le même nom) ET la task qu'on lui demande grâce à l'url ici de dire hello
            
            ProductsController::searchbarProduct();

            // Si on a un élément en url
            if (!empty($url[1]))
            {
                // Si le controller utilisé est "UserController"
                if ( $controllerName == "UsersController")
                {
                    // Si l'index 1 du l'url == register, instanciation de la requête concernée
                    if ( $url[1] == "register")
                    {
                        if ( empty ( $_SESSION['user_data'] ) )
                        {
                            $controllerName::register(); 
                        }
                        else {
                            header('location: profil');
                        }
                       
                    }
                    // Sinon si l'index 1 du l'url == login, instanciation de la requête concernée
                    elseif ( $url[1] == "login")
                    {
                        // Si aucune session n'est défini alors on affiche le form de connexion / Sinon redirection page profil
                        if ( empty ( $_SESSION['user_data'] ) )
                        {
                            $controllerName::login();
                        }
                        else {
                            header("Location: profil");
                        }
                    } 
                    // Sinon si l'index 1 du l'url == disconnect, instanciation de la requête concernée
                    elseif ( $url[1] == "disconnect")
                    {
                        $controllerName::disconnect();
                    }
                    // Sinon si l'index 1 du l'url == UpdateProfil, instanciation de la requête concernée
                    elseif ( $url[1] == "profil")
                    {
                        // Si une session user existe on affiche sinon redirection
                        if (!empty ($_SESSION['user_data']))
                        {
                            $controllerName::updateProfil();
                        } else {
                            header("Location: login");
                        }
                        
                    } 
                    elseif ( $url[1] == "forgotPassword")
                    {
                        $controllerName::forgotPassword();
                    }
                } 
            }


        
            if(!empty($url[1]) && empty($url[2])){
                if($controllerName == "ProductsController"){
                 $controllerName::seeProduct($url[1]);
                }            
            }elseif(!empty($url[1]) && !empty($url[2])){
                if($controllerName == "ProductsController"){
                    if($url[2] == 'update'){
                        $controllerName::seeUpdateProduct($url[1]);
                        }
                    }
                }
            elseif($controllerName == "ProductsController"){
                $controllerName::selectAllProducts();
                }

                // if($controllerName == "ImagesController"){
                //     $controllerName::seeProductImg();
                // }
            
            
        //cat à definir en amont 
        //refaire une query pour avoir une liste de categorie

        if($controllerName == "ProductsController")
        {
            if(!empty($url[1]))
            {
                // var_dump($url[1]);
              
                // // $controllerName::selectAllProducts();
                if($url[1] == 'makeup'||'skincare'){
                    // foreach($categories as $categorie){
                        // $controllerName::selectAllSousCategory();
                        // $controllerName::selectAllProductsCategory();
                        // $controllerName::getCategories();
                        $controllerName::createViewProducts();
                        // $controllerName::getNameCategories();
                        // $controllerName::seeProduct();
                        // $controllerName::productsByCategories();
                        // $controllerName::pagination(); 
                    }  
                // }
            }    
                // if($controllerName == "ProductsController")
                // {
                // // $controllerName::seeProduct($url[2]);
                // }
                 
            elseif(empty($url[1]))
                {
                    // $controllerName::pagination();
                    // $controllerName::seeProduct();
                    $controllerName::createViewProducts();

                    // $controllerName::selectAllProducts();
                    // $controllerName::selectAllSousCategory();
                    // $controllerName::getCategories();
                }
            // elseif(!empty($url[2]))
            // {

            // }
        } 

            if(@$url[1] == 'delete'){
            if ($controllerName == "BagsController") {
                $controllerName::showBag();
                $controllerName::deleteFromBag();
                }
            }elseif ($controllerName == "BagsController"){
                $controllerName::showBag();
                $controllerName::quantityBag(); 
            }
            


                if ($controllerName == "AdminController"){
                    if(empty($url[1]) && empty($url[2])){
                        Renderer::render('admin/backoffice');
                    }
                    elseif(!empty($url[1]) && empty($url[2])){
                        if($url[1] == 'create'){
                            Renderer::render('admin/addProduct');    
                        }elseif($url[1] == 'update'){
                            ProductsController::findAllProducts();
                            ImagesController::updateImage();
                        }elseif($url[1] == 'images'){
                            ImagesController::seeImages();
                        }
                    }elseif(!empty($url[1]) && !empty($url[2])){
                        if($url[1]== 'create' && $url[2] == 'image'){
                            ProductsController::selectAll();
                            ImagesController::uploadImage();
                        }
                    }
                }
        }      
    }   
}

     



