<?php

require_once('libraries/Renderer.php');


class CategoriesController extends Controller
{  

  

    public static function getCategories()
    {
        $catModel = new CategoriesModel();
        $categories = $catModel->findAll();
    }
    
}