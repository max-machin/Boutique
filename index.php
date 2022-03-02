<?php
// use Controllers\UsersController;

CONST urlmac = 'http://localhost:8888/Boutique/';

require_once('Autoloader.php');
Autoloader::Autoload();
Router::process();

?>

<p>je suis dans l'index</p>

