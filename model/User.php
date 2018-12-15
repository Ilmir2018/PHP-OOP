<?php

namespace app\model;

/*
 * Класс отражает структуру таблицы в базе данных.
 */

class User extends DataEntity
{
    public $id;
    public $orders_id;
    public $first_name;
    public $last_name;
    public $email;
    public $login;
    public $password;
}