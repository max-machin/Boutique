<?php

// require_once("models/ProductsModel.php");

try 
{
    //@var $bdd contient la connexion à la bdd 

    $bdd = new PDO ('mysql:host=localhost; dbname=boutique; charset=utf8', 'root', '');

    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

}

//Capture des exceptions et affichage de ses derniéres.

catch (PDOException $e)

{
    die("Erreur !: " . $e->getMessage() . "<br/>");
}


// Sécurisation des valeurs entré dans l'input
$content = trim(file_get_contents("php://input"));
$search = htmlspecialchars(trim($content)); 


// Requête de récupération des jeux contenant exactement la recherche de l'utilisateur dans le nom

$query = $bdd -> prepare('SELECT products.*, GROUP_CONCAT(images.url_image) as url FROM products INNER JOIN images ON products.id = images.id_product WHERE CONCAT(products.name,products.description,products.tags) LIKE :transformWord GROUP BY images.id_product');

    $query->execute([

        "transformWord" => $search.'%'

    ]);

    $result = $query->fetchAll();

    // Encodage en JSON pour fetch

    echo json_encode($result);

?>