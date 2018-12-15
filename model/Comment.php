<?php
/**
 * Created by PhpStorm.
 * User: Ilmir
 * Date: 04.11.2018
 * Time: 11:35
 */

namespace app\model;

/*
 * Класс отражает структуру таблицы в базе данных.
 */

class Comment extends DataEntity
{
    public $id;
    public $name;
    public $content;
}