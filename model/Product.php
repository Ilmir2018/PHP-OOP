<?php


namespace app\model; //Пространство имён.
//use \autoload\Autoloader as Al; //Псевдоним, для пространства имён, служащий для сокращения.
//as Al делается для избежания конфликтов если будет подкючен ещё один класс с таким же именем.

/*
 * Класс отражает структуру таблицы в базе данных.
 */

class Product extends DataEntity
{
    public $id;
    public $name;
    public $discription;
    public $price;
    public $category_id;
    public $path;

    public function getShortDescription(){
        return mb_substr($this->discription, 0, 10);
    }
}