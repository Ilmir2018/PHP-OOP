<?php

namespace app\models;

use app\services\String;

class Product extends DataEntity
{
    public $id;
    public $name;
    public $description;
    public $price;
    public $producer;
    public $img;

    public function getShortDescription()
    {
        return (new String())->substr($this->description);
    }
}