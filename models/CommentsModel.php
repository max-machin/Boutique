<?php

class Commentsmodel extends Model 
{
    protected $id_comments;
    protected $id_user;
    protected $id_product;
    protected $comment;

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
}