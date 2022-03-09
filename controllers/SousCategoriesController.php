<?php

class SousCategoriesController extends Controller
{  
  
    public static function getSousCategories()
    {
        $sousCatModel = new SousCategoriesModel();
        $sousCategories = $sousCatModel->findAll();

        return $sousCategories;
    }

}