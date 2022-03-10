<?php

class bagsModel extends Model
{

    protected $id;
    protected $id_user;
    protected $id_product;
    protected $price_product;
    protected $quantity_product;
    protected $id_color;

    public function __construct()
    {
        $this->table = "bags";

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
     * Get the value of id_users
     */ 
    public function getId_user()
    {
        return $this->id_user;
    }

    /**
     * Set the value of id_users
     *
     * @return  self
     */ 
    public function setId_user($id_user)
    {
        $this->id_user = $id_user;

        return $this;
    }

    /**
     * Get the value of id_products
     */ 
    public function getId_product()
    {
        return $this->id_product;
    }

    /**
     * Set the value of id_products
     *
     * @return  self
     */ 
    public function setId_product($id_product)
    {
        $this->id_product = $id_product;

        return $this;
    }

    /**
     * Get the value of quantite
     */ 
    public function getQuantity_product()
    {
        return $this->quantity_product;
    }

    /**
     * Set the value of quantite
     *
     * @return  self
     */ 
    public function setQuantity_product($quantity_product)
    {
        $this->quantity_product = $quantity_product;

        return $this;
    }

    /**
     * Récupération des caractéristiques et couleurs produits pour affichage en panier
     *
     * @param [type] $id_user
     * @return void
     */
    public function checkBagColors($id_user)
    {

        $this->database = DataBase::getPdo();

        $bag=$this->database -> prepare('SELECT products.id, products.name, products.price, bags.quantity_product, bags.id_color, colors.code, colors.name as color_name FROM `products` INNER JOIN bags ON products.id= id_product INNER JOIN colors ON bags.id_color = colors.id WHERE id_user=:id_user');
        $bag-> execute(['id_user'=>$id_user]);
        $resultBag=$bag->fetchAll();

        return($resultBag);
        // var_dump($result);
    }

    /**
     * Récupération des caractéristiques produits sans couleur pour affichage en panier
     *
     * @param [type] $id_user
     * @return void
     */
    public function checkBag($id_user)
    {

        $this->database = DataBase::getPdo(); 

        $bag=$this->database -> prepare('SELECT products.id, products.name, products.price, bags.quantity_product, bags.id_color  FROM `products` INNER JOIN bags ON products.id= id_product WHERE id_user=:id_user AND bags.id_color IS null');
        $bag-> execute(['id_user'=>$id_user]);
        $resultBag=$bag->fetchAll();

        return($resultBag);
        // var_dump($result);
    }

    /**
     * Update de la quantité d'un produit ne possédant pas de couleurs
     *
     * @param [type] $quantity_product
     * @param [type] $id_product
     * @param [type] $id_user
     * @return void
     */
    public function updateQuantity($quantity_product,$id_product, $id_user)
    {
        return $this->requete(" UPDATE $this->table SET `quantity_product` = ? WHERE `id_product` = ? AND id_user = ?", array($quantity_product,$id_product, $id_user));
    }

    /**
     * Update de la quantité d'un produit possédant des couleurs
     *
     * @param [type] $quantity_product
     * @param [type] $id_product
     * @param [type] $id_user
     * @param [type] $id_color
     * @return void
     */
    public function updateQuantityColors($quantity_product,$id_product, $id_user,$id_color)
    {
        return $this->requete(" UPDATE $this->table SET `quantity_product` = ? WHERE `id_product` = ? AND id_user = ? AND id_color = ?", array($quantity_product, $id_product, $id_user,$id_color));
    }

    /**
     * Récupération des produits en panier permettant d'initiliser un model commande afin d'inserer les produits commandés en BDD
     *
     * @param [type] $id_user
     * @return void
     */
    public function checkCommandBag($id_user) 
    {

        $this->database = DataBase::getPdo();

        $bag=$this->database -> prepare('SELECT products.id, products.price, bags.quantity_product, bags.id_color FROM `products` INNER JOIN bags ON products.id=id_product WHERE id_user=:id_user');
        $bag-> execute(['id_user'=>$id_user]);
        $resultBag=$bag->fetchAll();

        return($resultBag);
        // var_dump($result);
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
}