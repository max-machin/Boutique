<?php


    // var_dump($products);

    foreach($products as $product)
    {
        $url = explode(';', $product['url']);
        // var_dump($url);
            foreach($url as $test){
              $image = explode(',', $test);     
              if(isset($_POST['submit']))
                {
                    var_dump($_POST['id_image']);
                } 
              ?>
              <form action = "" method=post>
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
