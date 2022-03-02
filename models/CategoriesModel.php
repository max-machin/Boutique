<?php

class CategoriesModel extends Model 
{
    protected $id;
    protected $name;
   

    public function __construct()
    {
        $this->table = "categories";
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function findAllCategories()
    {
        $query = $this->requete("SELECT * FROM {$this->table} WHERE");
        // var_dump($query->fetchAll());
        // return ("test");
       return $query->fetchAll();
    }
}