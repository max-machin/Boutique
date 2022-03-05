<?php

class PromosModel extends Model
{
    protected $id;
    protected $code;
    protected $promo;

    public function __construct()
    {
        $this->table = "promos";
    }
}