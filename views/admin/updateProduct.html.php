<?php

if(@$_SERVER['user_data']['id'] !== 1)
{
  header('Location: urlLaura/index');
}

// appuyer sur choisir un fichier puis sur l'image pour envoyer :
// dans le front, faire en sorte que l'utilisateur clique sur l'image, donc stocke l'id de l'image puis ça sort un pop up avec le formulaire et un autre bouton pour valider (à voir si on le fait ou pas).

    foreach($products as $product)
    {
        $url = explode(';', $product['url']);
            foreach($url as $test){
              $image = explode(',', $test);     
              ?>
              
              <form action = "" method=post enctype="multipart/form-data">
              <input type="file" name="productImg">
                <button type=submit name="submit">              
                    <input type="hidden" name="id_image" value="<?= $image[1] ?>"/>
                    <img src="../Uploads/<?= $image[0] ?>" width="50px">
                </button>     
              </form>                
              <?php
            }
    ?>
     <h2><a href="<?= urlLaura ?>products/<?= $product['id'] ?>"><?= $product['name'] ?></a></h2>
</form>
    <?php
    }
?>
