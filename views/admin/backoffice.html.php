<?php

if(@$_SESSION['user_data']['id'] !== "1")
{
    header('Location:../index');
}

?>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>


<article>
    <h1>Backoffice</h1>

    <p>What do you want to do?</p>

    <form action="admin/create" method="post">
        <button type="submit" class="btn btn-outline-dark" name="goCreate">Create a new product</button>
    </form>

    <form action="admin/update" method="post">
        <button type="submit" class="btn btn-outline-dark" name="goUpdate">Update a product</button> 
    </form>
</article>

