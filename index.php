<?php
// use Controllers\UsersController;
session_start();

CONST url = 'http://localhost/Boutique/';
CONST urlmac = 'http://localhost:8888/Boutique/';
CONST urlLaura = 'http://localhost:8080/Boutique/';

require_once('Autoloader.php');
Autoloader::Autoload();
Router::process();

?>
<!-- <p>je suis dans l'index</p> -->

