<?php

require_once('libraries/Renderer.php');


class CategoriesController extends Controller
{  
    public function __construct()
    {
        $this->table = "categories";
    }

    public static function getCategories()
    {
        $catModel = new CategoriesModel();
        $categories = $catModel->findAll();
    }
    
}