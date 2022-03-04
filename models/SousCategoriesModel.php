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



    public function findAllSousCategories()
    {
        $query = $this->requete("SELECT * FROM `sous_categories` WHERE id_categorie = ");
     
        return $query->fetchAll();
    }
}