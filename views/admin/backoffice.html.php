<?php

if(@$_SESSION['user_data']['id'] !== "1")
{
    header('Location:../index');
}


//total * nbr / 100


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

    <section>
        <article class="panelAdmin">
            <div class="panelcard">
                <i class="fa-solid fa-users"></i>
                <div>
                    <p><?= $findUsers[0]['COUNT(*)'] ?></p>
                    <p>Nombre d'utilisateurs</p>
                </div>
            </div>
            <div class="panelcard">
                <i class="fa-solid fa-box"></i>
                <div>
                    <p><?= $findProducts[0]['COUNT(*)'] ?></p>
                    <p>Nombre de produits</p>
                </div>
            </div>
            <div class="panelcard">
                <i class="fa-solid fa-cart-arrow-down"></i>
                <div>
                    <p><?= count($nbrCommand) ?></p>
                    <p>Nombre de commandes</p>
                </div>
            </div>
            <div class="panelcard">
                <i class="fa-solid fa-money-bill"></i>
                <div>
                    <p><?= $chiffreAffaire['prix'] ?> €</p>
                    <p>Chiffre d'affaires</p>
                </div>
            </div>
        </article>
    </section>

    <h2 class="text-center">Best Sellers</h2>
        <div class="graph">
            <?php 
                foreach ($bestSellers as $produit)
                {
                    $name = explode(",", $produit['product_name']);
                    $nameProduit = array_unique($name);        
                    $resultat = (count($name)/$nbrProduit[0]['COUNT(*)']) * 100;

                    $id = explode(",", $produit['id']);
                    $numero = array_unique($id);
                    ?>
                    <div class="colonne">
                        <div class="bar bar<?= $numero[0] ?>" style="height: <?= round($resultat) ?>%">
                            <p><?= round($resultat) ?>%</p>
                        </div>
                        <p><?= $nameProduit[0] ?></p>
                        <p>x <?= count($name) ?></p>
                    </div>
                    <?php
                }
            ?>
        </div>
</article>

