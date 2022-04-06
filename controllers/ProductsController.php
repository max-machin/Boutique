<?php

require_once('libraries/Renderer.php');

class ProductsController extends Controller
{  
    
    public static function selectAllProducts(){

        $model = new ProductsModel();
        $products = $model->findAllProducts(); 
        // foreach($products as $product){
        //     $images = explode(',', $product->url); 
        //  }      
         Renderer::render('products/allProducts' , compact('products'));    
    }

    public static function selectAll(){
        $model = new ProductsModel();
        $products = $model->findAll();
        Renderer::render('admin/uploadImage' , compact('products'));    
    }

    public static function seeProduct($id){
        $model = new ProductsModel();
        $soloproduct = $model->selectProductbyId($id);
        foreach($soloproduct as $product){
            $images = explode(',', $product['url']); 
         }  

        $productModel = new ProductsModel();
        $product = $productModel->find($id);

        if ( empty($product))
        {
            header('location: ../products');
        }

        if ( isset ($_POST['addBag']))
        {
        $model = new BagsModel();
        $productAdded = $model
        ->setId_user($id_user)
        ->setId_product($id_product)
        ->setQuantity_product($quantity);

        // $productAdded->create($model);  
        }

        $commentModel = new CommentsModel();
        $allComments = $commentModel->productComment($id);

        $errorComment = "";

        if ( isset ($_POST['addComment']))
        {
            if ( !empty ($_POST['comment']))
            {
                $model = new CommentsModel();
                $comment = valid_data($_POST['comment']);

                $comment = $model
                    ->setId_product($_POST['id_product'])
                    ->setId_user( $_SESSION['user_data']['id'])
                    ->setComment( $comment )
                    ->setDate(date('Y-m-d H:i:s'))
                    ->setNote($_POST['star']);
                $comment->create($model);
                header('refresh: 0');

            } else {
                $errorComment = "Veuillez remplir le champ";
            }
        }
        Renderer::render('products/seeProduct' , compact('product', 'images', 'allComments', 'errorComment'));
    }


    public static function seeUpdateProduct($id)
    {
        // var_dump($id);
        $model = new ProductsModel();
        $product = $model->find($id);
        Renderer::render('products/updateProduct' , compact('product'));
    }

    public static function updateProduct()
    {
        $model = new ProductsModel();
        $updateProduit = $model
         ->SetId($_SESSION['product']['id'])
         ->SetName($_SESSION['product']['name'])
         ->setDescription($_SESSION['product']['description'])
         ->setPrice($_SESSION['product']['price']);
         $updateProduit->update($model);
 
     }

    public static function createProduct()
    {
        $model = new ProductsModel();
        $product = $model
            ->setId_sous_categorie($_SESSION['subcategory']['id'])
            ->setId_categorie($_SESSION['category']['id'])
            ->setPrice($_POST['price'])
            ->setDescription($_POST['description'])
            ->setName($_POST['name']);
        $product->create($model); 
    }
    
    public static function deleteProduct(){
        // $model = new ProductsModel();
        // var_dump($product = $model->delete((3)));
        
    }
    public static function getCategories()
    {
        $model = new CategoriesModel();
        $categories = $model->findAll();
      
        return $categories;
    }

    public static function getSousCategories($cat) 
    {
        $modelSousCat = new SousCategoriesModel();
        $sousCategories = $modelSousCat->findSousCategories($cat);

        return $sousCategories;
    }
    
    public static function getCategorieName()
    {
        $categories = self::getCategories();

        $nameCategorie = [];

        foreach ($categories as $categorie )
        {
    
            array_push($nameCategorie, $categorie['name']);
        }
      
        return $nameCategorie;
    }

    public static function getSousCategorieName($cat)
    {
        $sousCategories = self::getSousCategories($cat);

        $nameSousCategorie = [];

        foreach ($sousCategories as $sousCategorie )
        {
    
            array_push($nameSousCategorie, $sousCategorie['name']);
        }
        //  var_dump($nameSousCategorie);
        return $nameSousCategorie;
    }


    public static function productsByCategories($nameCategorie)
    {
        $model = new ProductsModel();
        $productsCat = $model->productsByCategorie($nameCategorie);

        return $productsCat;

    }

    public static function productsBySousCategories($nameCategorie)
    {
        $model = new ProductsModel();
        $productsSousCat = $model->productsBySousCategories($nameCategorie);

        return $productsSousCat;

    }

    public static function getUrl($qry)
    {
            $result = array();
     
             if(strpos($qry,'?')!==false) {
               $q = parse_url($qry);
               $qry = $q['query'];
              }
            else {
                    return false;
            }

            foreach (explode('&', $qry) as $couple) {
                    list ($key, $val) = explode('=', $couple);
                    $result[$key] = $val;
            }

            return $result;
    }

    
    public static function getUrlCategories()
    {

        $categorieUrl = self::getCategorieName();

        $url = explode("/", filter_var($_GET['p'], FILTER_SANITIZE_URL));
        // var_dump($url);
        return $url;
        
    }


    //pagination va prendre en paramètre des countsrproducts all , cat et sous cat. Il va également recevoir en paramètre le resultat de la requete select...
    public static function paginationSousCat()
    {
        $model = new ProductsModel();
        $sousCat = self::getUrlCategories();

        $products = $model->productsBySousCategories(@$sousCat[2]);

        $countProductsSousCat = count($products);

        $page = null;
        if($page === 0){

            $page === 1;
        }
       
        $nbrProductsByPage = 2;
        $nbrPagesSousCat = ceil($countProductsSousCat / $nbrProductsByPage);
       
        return array ($page, $nbrProductsByPage, $nbrPagesSousCat, $countProductsSousCat);
        
    }
    
    public static function paginationCat()
    {
        $model = new ProductsModel();
        $catUrl = self::getUrlCategories();

       
        $productsCat = $model->productsByCategorie($catUrl[1]);

        $countProductsCat = count($productsCat);

        $page = null;
        if($page === 0){

            $page === 1;
        }
       
        $nbrProductsByPage = 2;
        $nbrPagesCat = ceil($countProductsCat / $nbrProductsByPage);
     
      
        return array ($page, $nbrProductsByPage, $nbrPagesCat, $countProductsCat);
        
    }
           
    public static function createViewProducts($cat = null, $sousCat = null) 
    {
        $model = new ProductsModel();
        $categories = self::getCategories();
        $nameCategorie = self::getCategorieName();
        $pagination = self::paginationCat();
        $paginationSousCat = self::paginationSousCat();
        $nameSousCategorie = self::getSousCategorieName($cat);
        $recupSousCat = self::getUrlCategories();
        $sousCategories = self::getSousCategories($cat);
        
        $sousCat = @$recupSousCat[2];
        $cat = @$recupSousCat[1];
     
        $page = $pagination[0];
        $nbrProductsByPage = $pagination[1];
        $nbrPagesCat = $pagination[2];
        $nbrPagesSousCat = $paginationSousCat[2];
       
        $countProductsCat = $pagination[3];
        $countProductsSousCat = $paginationSousCat[3];
        
       
        if (!empty($sousCat) ) {
            
            $products = self::productsBySousCategories($sousCat);
             
            $pagination = self::paginationSousCat();
            $nameSousCategorie = self::getSousCategorieName($cat);
            $sousCategories = self::getSousCategories($cat);
            
        } 
        else if (!empty($cat)) {
            
            $products = self::productsByCategories($cat);
            $pagination = self::paginationCat();
            $nameCategorie = self::getCategorieName();
            $categories = self::getCategories();
          
        } 
        
       
        Renderer::render('products/allProducts' , compact('categories','nameCategorie', 'nbrPagesCat','nbrPagesSousCat', 'sousCategories', 'products', 'nameSousCategorie', 'page','nbrProductsByPage','countProductsCat', 'countProductsSousCat'));
       
    }
    
    
}
    
//! faire une fonction pour make up et une func pour skincare avec deux renderer différents 