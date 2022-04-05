<?php
require_once('../libraries/Database.php');

    $database = DataBase::getPdo();

    $content = trim(file_get_contents("php://input"));

        $normalProducts= $database -> prepare('SELECT * FROM `products` WHERE `id_quizz`= 3');
        $normalProducts -> execute();
        $resultNormal = $normalProducts->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($resultNormal);
?>