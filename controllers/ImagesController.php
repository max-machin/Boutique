<?php

require_once('libraries/Renderer.php');

class ImagesController extends Controller
{  
    public static function uploadImage() {

        Renderer::render('admin/uploadImage');

        if(isset($_POST['sauvimg']))
        {
            $_SESSION['products']['id'] = $_POST['products'];
            $file=$_FILES['productImg'];
            $fileName=$_FILES['productImg']['name'];
            $fileType=$_FILES['productImg']['type'];
            $fileTmpName=$_FILES['productImg']['tmp_name'];
            $fileSize=$_FILES['productImg']['size'];
            $fileError=$_FILES['productImg']['error'];

            $fileExt = explode('.', $fileName); 
            $fileActExt = strtolower(end($fileExt)); 
          
            $allowedExt = array('jpeg', 'jpg', 'png');
            
            if (in_array($fileActExt, $allowedExt)){
          
              if ($fileError === 0){
                
                if ($fileSize < 1000000){
                    $fileDestination = "Uploads/".$fileName;
                    move_uploaded_file($fileTmpName, $fileDestination);

                    ImagesModel::uploadImage($fileName, $_SESSION['products']['id']);
                    }
                }   
            }
        }
    }

    public static function imageProduct($productId){
        $modelBis = new ImagesModel();
        $productImg = $modelBis->seeImage($productId);
        // var_dump($productImg);

        foreach($productImg as $image){
            // var_dump($image->url_image);
?>
    <img src="Uploads/<?= $image->url_image ?>" width="50px">
<?php
        }
    }

    public static function imageForProduct($productId){
        $modelBis = new ImagesModel();
        $productImg = $modelBis->seeImageProduct($productId);
        foreach($productImg as $image){
            var_dump($image->url_image);
?>
    <img src="../Uploads/<?= $image->url_image ?>" width="50px">
<?php
        }
    }
}