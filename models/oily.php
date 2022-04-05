<?php
require_once('../libraries/Database.php');

    $database = DataBase::getPdo();

    $content = trim(file_get_contents("php://input"));

        $oilyProducts= $database -> prepare('SELECT products.*, GROUP_CONCAT(images.url_image SEPARATOR ",") as url FROM `products` INNER JOIN images ON products.id = images.id_product WHERE `id_quizz`= 1');
        $oilyProducts -> execute();
        $resultOily = $oilyProducts->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($resultOily);
?>