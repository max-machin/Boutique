<?php
function valid_data($données)
{
    //trim permet de supprimer les espaces inutiles
    $données = trim($données);
    //stripslashes supprimes les antishlashs
    $données = stripslashes($données);
    //htmlspecialchars permet d'échapper certains caractéres spéciaux et les transforment en entité HTML
    $données = htmlspecialchars($données);
    return $données;
} 

class ProductsController extends Controller
{  
    
    public static function selectAllProducts(){
        $model = new ProductsModel();
        $products = $model->findAll();
        Renderer::render('products/allProducts' , compact('products'));
    }

    public static function seeProduct($id){

        $productModel = new ProductsModel();
        $product = $productModel->find($id);

        if ( empty($product))
        {
            header('location: ../products');
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


        Renderer::render('products/seeProduct' , compact('product' , 'allComments', 'errorComment'));
    }
}