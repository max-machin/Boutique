<?php

class CommandsModel extends Model
{
    protected $id;
    protected $id_command;
    protected $id_user;
    protected $id_product;
    protected $quantity_product;
    protected $id_color;
    protected $price;
    protected $total_price;
    protected $promo;
    protected $date;
    protected $adresse_livraison;
    protected $adresse_facturation;
    protected $price_livraison;
    protected $mode;
    

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

    /**
     * Get the value of adresse_livraison
     */ 
    public function getAdresse_livraison()
    {
        return $this->adresse_livraison;
    }

    /**
     * Set the value of adresse_livraison
     *
     * @return  self
     */ 
    public function setAdresse_livraison($adresse_livraison)
    {
        $this->adresse_livraison = $adresse_livraison;

        return $this;
    }

   

    /**
     * Get the value of adresse_facturation
     */ 
    public function getAdresse_facturation()
    {
        return $this->adresse_facturation;
    }

    /**
     * Set the value of adresse_facturation
     *
     * @return  self
     */ 
    public function setAdresse_facturation($adresse_facturation)
    {
        $this->adresse_facturation = $adresse_facturation;

        return $this;
    }

    /**
     * Get the value of id_color
     */ 
    public function getId_color()
    {
        return $this->id_color;
    }

    /**
     * Set the value of id_color
     *
     * @return  self
     */ 
    public function setId_color($id_color)
    {
        $this->id_color = $id_color;

        return $this;
    }

    /**
     * Get the value of total_price
     */ 
    public function getTotal_price()
    {
        return $this->total_price;
    }

    /**
     * Set the value of total_price
     *
     * @return  self
     */ 
    public function setTotal_price($total_price)
    {
        $this->total_price = $total_price;

        return $this;
    }

    /**
     * Récupération du numéro de commande afin de l'incrémenter pour le prochaine commande entrée en BDD
     *
     * @return void
     */
    public function checkNumCommand()
    {
        return $this->requete("SELECT MAX(id_command) from commands")->fetch();
    }

    /**
     * Récupération de la totalité des informations des commandes de l'utilisateur 
     *
     * @param [type] $id_user
     * @return void
     */
    public function userCommand($id_user)
    {
        return $this->requete("SELECT * FROM {$this->table} WHERE id_user = ?", array($id_user))->fetchAll();
    }
    
    /**
     * Récupération des commandes de l'utilisateur en concatenant les informations d'une commmande selon le NUMERO DE COMMANDE
     *
     * @param [type] $id_user
     * @return void
     */
    public function findCommand($id_user)
    {
        return $this->requete("SELECT DISTINCT GROUP_CONCAT(c.id) as id,GROUP_CONCAT(id_command) as id_command,GROUP_CONCAT(quantity_product) as quantity_product, GROUP_CONCAT(p.name) as product_name ,GROUP_CONCAT(c.id_color) as product_color,GROUP_CONCAT(c.price) as price, GROUP_CONCAT(total_price) as total_price ,GROUP_CONCAT(date) as date,GROUP_CONCAT(promo) as promo ,GROUP_CONCAT(adresse_livraison) as adresse_livraison ,GROUP_CONCAT(adresse_facturation) as adresse_facturation , GROUP_CONCAT(p.name) as product_name, GROUP_CONCAT(c.price_livraison) as price_livraison, GROUP_CONCAT(c.mode) as mode FROM {$this->table} as c INNER JOIN products as p ON c.id_product = p.id WHERE id_user = ? GROUP BY id_command", array($id_user))->fetchAll();
    }

    /**
     * Get the value of price_livraison
     */ 
    public function getPrice_livraison()
    {
        return $this->price_livraison;
    }

    /**
     * Set the value of price_livraison
     *
     * @return  self
     */ 
    public function setPrice_livraison($price_livraison)
    {
        $this->price_livraison = $price_livraison;

        return $this;
    }

    /**
     * Get the value of mode
     */ 
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * Set the value of mode
     *
     * @return  self
     */ 
    public function setMode($mode)
    {
        $this->mode = $mode;

        return $this;
    }
}