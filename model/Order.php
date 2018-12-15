<?php

namespace app\model;

/*
 * Класс отражает структуру таблицы в базе данных.
 */

class Order extends DataEntity
{
    public $id;
    public $user_id;
    public $price;
}