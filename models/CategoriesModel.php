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

}