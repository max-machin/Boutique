<?php
require_once('../libraries/Database.php');

    $database = DataBase::getPdo();

    $content = trim(file_get_contents("php://input"));

        $dryProducts= $database -> prepare('SELECT * FROM `products` WHERE `id_quizz`= 2');
        $dryProducts -> execute();
        $resultDry = $dryProducts->fetchAll(PDO::FETCH_ASSOC);

        // var_dump($resultDry);

        // echo 'hey';
    echo json_encode($resultDry);
?>