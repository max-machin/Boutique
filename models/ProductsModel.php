<?php

class ProductsModel extends Model
{
    protected $id;
    protected $name;
    protected $description;
    protected $price;
    protected $id_categories;
    protected $id_sous_categories;

    public function __construct()
    {
        $this->table = "products";
    }



    /**
     * Get the value of id_sous_categories
     */ 
    public function getId_sous_categories()
    {
        return $this->id_sous_categories;
    }

    /**
     * Set the value of id_sous_categories
     *
     * @return  self
     */ 
    public function setId_sous_categories($id_sous_categories)
    {
        $this->id_sous_categories = $id_sous_categories;

        return $this;
    }

    /**
     * Get the value of id_categories
     */ 
    public function getId_categories()
    {
        return $this->id_categories;
    }

    /**
     * Set the value of id_categories
     *
     * @return  self
     */ 
    public function setId_categories($id_categories)
    {
        $this->id_categories = $id_categories;

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
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of id_products
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id_products
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    // public function countProducts()
    // {
    //     $query = $this->requete("SELECT COUNT(*) AS list FROM {$this->table}");
    //     return $query->fetchAll();
    // }

    public function productsByPage($nbr_products_by_page,$debut)
    {
        $query = $this->requete("SELECT * FROM {$this->table} DESC LIMIT $debut , $nbr_products_by_page");
        return $query->fetchAll();
    }

    public function productsByCategories() 
    {
        $query = $this->requete("SELECT COUNT(products.id_categorie) 
        AS liste_cat 
        FROM {$this->table} 
        INNER JOIN `categories` 
        ON categories.id = products.id_categorie WHERE categories.name = '$page_categorie'");
        return $query->fetchAll();
    }

    public function productsBySousCategories()
    {
        $query = $this->requete("SELECT products.*, categories.name 
        FROM {$this->table}  
        INNER JOIN categories 
        ON categories.id = products.id_categorie 
        WHERE categories.name = '$page_categorie' 
        DESC 
        LIMIT $debut_cat");
         return $query->fetchAll();
    }
    
    
}