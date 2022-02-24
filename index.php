<?php
// use Controllers\UsersController;
session_start();

require_once('Autoloader.php');
Autoloader::Autoload();
Router::process();
?>


<p>je suis dans l'index</p>

