<?php
require_once('../libraries/Database.php');

    $database = DataBase::getPdo();

    $content = trim(file_get_contents("php://input"));

        $oilyProducts= $database -> prepare('SELECT * FROM `products` WHERE `id_quizz`= 1');
        $oilyProducts -> execute();
        $resultOily = $oilyProducts->fetch(PDO::FETCH_ASSOC);

    echo json_encode($resultOily);
?>