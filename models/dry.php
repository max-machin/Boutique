<?php
require_once('../libraries/Database.php');

    $database = DataBase::getPdo();

    $content = trim(file_get_contents("php://input"));

        $dryProducts= $database -> prepare('SELECT * FROM `products` WHERE `id_quizz`= 2');
        $dryProducts -> execute();
        $resultDry = $dryProducts->fetch(PDO::FETCH_ASSOC);

    echo json_encode($resultDry);
?>