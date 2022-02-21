<?php

class BagsController extends Controller
{
    public function __construct()
    {
        $model = new BagsModel();

        echo "je suis dans bags controller";
         
    }

    public function insertBag()
    {
        $productBag = $model->create(); 
        $productAdded = $productBag
        ->setId_user(1)
        ->setId_product(1)
        ->setQuantite_product(1)
        ->setPrice_product(1);

        var_dump($productAdded);
    }
}