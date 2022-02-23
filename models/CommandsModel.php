<?php

class CommandsModel extends Model
{
    protected $id;
    protected $name;
    // protected $description;
    // protected $price;
    // protected $id_categories;
    // protected $id_sous_categories;

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