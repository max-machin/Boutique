<?php

class SousCategoriesModel extends Model
{
     /**
     * Fonction construct indique la table concernée par le modele
     */
    public function __construct()
    {
        $this->table = "sous_categories";
    }



    public function findSousCategories($nameCategorie)
    {
        $this->database = DataBase::getPdo();

        $query = $this->database->prepare("SELECT sous_categories.* FROM `sous_categories` INNER JOIN `categories` ON sous_categories.id_categorie = categories.id WHERE categories.name = :nameCategorie");
        $query ->execute(['nameCategorie' => $nameCategorie]);
       
        return $query->fetchAll();
    }
}