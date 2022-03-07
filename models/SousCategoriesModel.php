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



    public function findSousCategories()
    {
        $query = $this->requete("SELECT * FROM `sous_categories` INNER JOIN `categories` WHERE sous_categories.id_categorie = categories.id");
       
        return $query->fetchAll();
    }
}