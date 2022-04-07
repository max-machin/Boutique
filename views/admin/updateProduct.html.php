
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<?php

if(@$_SESSION['user_data']['id'] !== "1")
{
  header('Location:../accueil');
}



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
                    <img src="./uploads/<?= $image[0] ?>" width="50px" class="btn btn-outline-dark">
                </button>     
              </form>                
              <?php
            }
    ?>
     <h2><a href="products/<?= $product['id'] ?>"><?= $product['name'] ?></a></h2>
</form>
    <?php
    }
?>
