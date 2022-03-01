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
}