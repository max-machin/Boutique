<?php

class SousCategoriesController extends Controller
{  
    public function __construct()
    {
        $this->table = "sous_categories";
    }

    public static function getSousCategories()
    {
        $sousCatModel = new SousCategoriesModel();
        $sousCategories = $sousCatModel->findAll();

        return $sousCategories;
    }

}