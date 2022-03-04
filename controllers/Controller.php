<?php

/**
 * Class Controller : class permettant la gestion de l'affichage des données dans les views
 * à l'aide des fonctions ob_start et ob_get_clean permettant de stocker en mémoire les informations à afficher
 * Cette classe créera également les chemin d'accés aux views en fonction de la demande url 
 * On pourra également lui renseigner une template qui se situera dans les views
 */
abstract class Controller
{
    public static function preventXSS($string){
        //permet d'éviter les XSS (cross-site scripting) injections (plus ou moins fool-proof)
        $allowed_tags = array('<p>', '<a>', '<h1>', '<h2>', '<h3>', '<body>', '<head>', '<nav>');
        $test = strip_tags($string, $allowed_tags = null);
        echo htmlspecialchars($test, ENT_QUOTES, 'UTF-8');
    }
}