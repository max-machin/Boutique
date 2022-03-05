<?php
// use Controllers\UsersController;
session_start();
define('promos', "");
CONST codePromo = "CREAMYDELUXE";
CONST url = 'http://localhost/Boutique/';
CONST urlmac = 'http://localhost8888/Boutique/';

require_once('Autoloader.php');
Autoloader::Autoload();
Router::process();

$promo = "";
?>

<!-- <p>je suis dans l'index</p> -->

