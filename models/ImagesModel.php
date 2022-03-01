<?php


class ImagesModel extends Model
{
    protected $id;
    protected $id_product;
    protected $url_image;
    private $database;


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
     * Get the value of url_image
     */ 
    public function getUrl_image()
    {
        return $this->url_image;
    }

    /**
     * Set the value of url_image
     *
     * @return  self
     */ 
    public function setUrl_image($url_image)
    {
        $this->url_image = $url_image;

        return $this;
    } 

    public static function uploadImage($url_image, $id_product)
    {
        $this->database = DataBase::getPdo();

        $updateImg=$database-> prepare("UPDATE `images` SET `url_image`=: url_image WHERE id_product=:id_product");
        $updateImg -> execute(['url_image' => $url_image,'id_product' => $id_product]);
    }
}