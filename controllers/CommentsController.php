<?php

class CommentsController extends Controller
{

    public function insert()
    {
        
        $articleModel = new ProductsModel();
       
        //On commence par le pseudo
        // $author = null;
        // if (!empty($_POST['author'])) {
        //     $author = $_POST['author'];
        // }

        // Ensuite le contenu
        $content = null;
        if (!empty($_POST['content'])) {
            // On fait quand même gaffe à ce que le gars n'essaye pas des balises cheloues dans son comment 
            $content = htmlspecialchars($_POST['content']);
        }

        // Enfin l'id de l'article
        $product_id = null;
        if (!empty($_POST['product_id']) && ctype_digit($_POST['product_id'])) {
            $product_id = $_POST['product_id'];
        }

        // Vérification finale des infos envoyées dans le formulaire (donc dans le POST)
        // Si il n'y a pas d'auteur OU qu'il n'y a pas de contenu OU qu'il n'y a pas d'identifiant d'article
        if (!$author || !$product_id || !$content) {
            die("Votre formulaire a été mal rempli !");
        }

        // var_dump($product_id);

        $article = $articleModel->find($product_id);

        // Si rien n'est revenu, on fait une erreur
        if (!$product_id) {
            die("Ho ! L'article $product_id n'existe pas boloss !");
        }

        // 3. Insertion du comment 
        $comment = $this->model->insert('Laura','Ce produit vaut vraiment le coup',$product_id);

        // // 4. Redirection vers l'article en question :
        // Http::redirect('article.php?id=' . $product_id);
    }

    public function delete()
    {
  
        /**
         * 1. Récupération du paramètre "id" en GET
         */
        if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
            die("Ho ! Fallait préciser le paramètre id en GET !");
        }

        $id = $_GET['id'];

        /**
         * 3. Vérification de l'existence du comment 
         */
        $comment  = $this->model->find($id);
        if (!$comment ) {
            die("Aucun comment  n'a l'identifiant $id !");
        }

        /**
         * 4. Suppression réelle du comment 
         * On récupère l'identifiant de l'article avant de supprimer le comment 
         */
        var_dump($comment );
        $product_id = $comment ['product_id'];
        $this->model->delete($id);

        /**
         * 5. Redirection vers l'article en question
         */

        //avant: header("Location: article.php?id=" . $product_id);
        // exit();

        // \Http::redirect("article.php?id=" . $id);
    }
}
 
