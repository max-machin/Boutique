<?php

class CommandsModel extends Model
{
    protected $id;
    protected $id_command;
    protected $id_user;
    protected $id_product;
    protected $quantity_product;
    protected $price;
    protected $promo;
    protected $date;


    public function __construct()
    {
        $this->table = "commands";
    }


    /**
     * Get the value of id_promo
     */ 
    public function getId_promo()
    {
        return $this->id_promo;
    }

    /**
     * Set the value of id_promo
     *
     * @return  self
     */ 
    public function setId_promo($id_promo)
    {
        $this->id_promo = $id_promo;

        return $this;
    }

    /**
     * Get the value of price
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */ 
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of quantity_product
     */ 
    public function getQuantity_product()
    {
        return $this->quantity_product;
    }

    /**
     * Set the value of quantity_product
     *
     * @return  self
     */ 
    public function setQuantity_product($quantity_product)
    {
        $this->quantity_product = $quantity_product;

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
     * Get the value of id_command
     */ 
    public function getId_command()
    {
        return $this->id_command;
    }

    /**
     * Set the value of id_command
     *
     * @return  self
     */ 
    public function setId_command($id_command)
    {
        $this->id_command = $id_command;

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


    public function checkNumCommand()
    {
        return $this->requete("SELECT MAX(id_command) from commands")->fetch();
    }

    public function userCommand($id_user)
    {
        return $this->requete("SELECT * FROM {$this->table} WHERE id_user = ?", array($id_user))->fetchAll();
    }
    
    public function findCommand($id_user, $id_command)
    {
        return $this->requete("SELECT * FROM {$this->table} WHERE id_user = ? GROUP BY id_command = ?", array($id_user, $id_command))->fetchAll();
    }

    /**
     * Get the value of promo
     */ 
    public function getPromo()
    {
        return $this->promo;
    }

    /**
     * Set the value of promo
     *
     * @return  self
     */ 
    public function setPromo($promo)
    {
        $this->promo = $promo;

        return $this;
    }
}