<?php
/**
 * Created by PhpStorm.
 * User: Ilmir
 * Date: 26.10.2018
 * Time: 18:40
 */

namespace app\model\repositories;


use app\model\Product;

//Класс для работы с данными о товарах из таблицы products в БД.
class ProductRepository extends Repository
{
    public function getTableName()
    {
        return 'products';
    }
    public function getEntityClass()
    {
        return Product::class;
    }

}