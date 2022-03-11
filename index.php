<?php
// use Controllers\UsersController;
session_start();
define('promos', "");
CONST codePromo = "CREAMYDELUXE";
CONST url = 'http://localhost/Boutique/';
CONST urlmac = 'http://localhost8888/Boutique/';
CONST urlLaura = 'http://localhost:8080/Boutique/';

// $urlOK = $_SERVER['HTTP_REFERER'] . $_SERVER['REQUEST_URI'];

require_once('Autoloader.php');
Autoloader::Autoload();
Router::process();

$promo = "";
?>

<!-- <p>je suis dans l'index</p> -->

