<?php

class FavorisModel extends Model
{
    protected $id;
    protected $id_user;
    protected $id_product;
    protected $fav;

    public function __construct()
    {
        $this->table = 'favoris';
    }

    /**
     * Get the value of fav
     */ 
    public function getFav()
    {
        return $this->fav;
    }

    /**
     * Set the value of fav
     *
     * @return  self
     */ 
    public function setFav($fav)
    {
        $this->fav = $fav;

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
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Reqûete de récupération des favoris selon l'id du produit et l'id de l'utilisateur permattant d'add/delete des favoris
     *
     * @param [type] $id_user
     * @param [type] $id_product
     * @return void
     */
    public function findFavoris($id_user, $id_product)
    {
        return $this->requete("SELECT * FROM favoris WHERE id_user = ? AND id_product = ?", array($id_user, $id_product))->fetch();
    }

    /**
     * Requête de récupération des favoris selon l'id produit, user et selon un "signal"
     *
     * @param [type] $id_user
     * @param [type] $id_product
     * @return void
     */
    public function findFavorisUser($id_user, $id_product)
    {
        return $this->requete("SELECT * FROM favoris WHERE id_user = ? AND id_product = ? AND fav = 1", array($id_user, $id_product))->fetch();
    }
}