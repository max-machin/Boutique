<?php

class SousCategoriesModel extends Model
{
    protected $id;
    protected $id_categorie;
    protected $name;

     /**
     * Fonction construct indique la table concernée par le modele
     */
    public function __construct()
    {
        $this->table = "sous_categories";
    }

}