<?php

class Commentsmodel extends Model 
{
    protected $id_comments;
    protected $id_user;
    protected $id_product;
    protected $comment;
    protected $note;
    protected $date;

    public function __construct()
    {
        $this->table = 'comments';
    }

    /**
     * Get the value of comment
     */ 
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set the value of comment
     *
     * @return  self
     */ 
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get the value of id_product
     */ 
    public function getId_product()
    {
        return $this->id_product;
    }

    /**
     * Set the value of id_product
     *
     * @return  self
     */ 
    public function setId_product($id_product)
    {
        $this->id_product = $id_product;

        return $this;
    }

    /**
     * Get the value of id_user
     */ 
    public function getId_user()
    {
        return $this->id_user;
    }

    /**
     * Set the value of id_user
     *
     * @return  self
     */ 
    public function setId_user($id_user)
    {
        $this->id_user = $id_user;

        return $this;
    }

    /**
     * Get the value of id_comments
     */ 
    public function getId_comments()
    {
        return $this->id_comments;
    }

    /**
     * Set the value of id_comments
     *
     * @return  self
     */ 
    public function setId_comments($id_comments)
    {
        $this->id_comments = $id_comments;

        return $this;
    }

    /**
     * Get the value of note
     */ 
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set the value of note
     *
     * @return  self
     */ 
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get the value of date
     */ 
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */ 
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    public function findProductNote( $id_product)
    {
        return $this->requete("SELECT AVG(note) as note from comments INNER JOIN products ON comments.id_product = products.id WHERE comments.id_product = ?" , array($id_product))->fetchAll();
    }

    /**
     * Requête de récupération des données des commentaires relatifs au produit
     *
     * @param [type] $id
     * @return void
     */
    public function productComment($id)
    {
        return $this->requete("SELECT users.prenom, comments.comment, comments.note, DATE_FORMAT(date, '%d/%m/%Y') AS 'datefr' , DATE_FORMAT(date, '%H:%i:%s') AS 'heurefr' FROM `comments` INNER JOIN `users` WHERE comments.id_user = users.id AND comments.id_product = $id ORDER BY date DESC")->fetchAll();
    }

    /**
     * Requête de récupération des données des commentaires relatifs à l'utilisateur 
     *
     * @param [type] $id_user
     * @return void
     */
    public function userComments($id_user)
    {
        return $this->requete("SELECT products.id as id_product ,products.name, comments.comment, comments.note, comments.id, DATE_FORMAT(date, '%M/%d/%Y') AS 'datefr' , DATE_FORMAT(date, '%H:%i:%s') AS 'heurefr' FROM `comments` INNER JOIN `products` ON comments.id_product = products.id AND comments.id_user = $id_user ORDER BY date DESC")->fetchAll();
    }

    public function findCommentsByProduct(){
        return $this->requete("SELECT u.prenom, p.name, c.comment, c.note, c.date, c.id_product, c.id FROM comments as c INNER JOIN products as p ON c.id_product = p.id INNER JOIN users as u ON c.id_user = u.id ORDER BY p.name")->fetchAll();
    }
}