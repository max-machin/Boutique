<?php

/**
 *? Class Autoloader : Permets le chargement dynamique des class appelé lors d'une action
 */
spl_autoload_register(function ($class){
    //moi je veux que mon classname soit ControllerAccueil
    // $class = str_replace("\\", "/", $class);
    // var_dump($class);
    // var_dump("./classes/".$class.".php");
    
    if (file_exists("./controllers/".$class.".php")){
        require_once("./controllers/".$class.".php");
    } 
    if (file_exists("./models/".$class.".php")) {
        require_once("./models/".$class.".php");
    }
    if (file_exists("./libraries/".$class.".php")) {
        require_once("./libraries/".$class.".php");
    }

});