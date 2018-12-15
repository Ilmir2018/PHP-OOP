<?php
/**
 * Created by PhpStorm.
 * User: Ilmir
 * Date: 29.10.2018
 * Time: 13:02
 */

namespace app\services;


class Session
{

    //Открытие сессии.
    public function __construct()
    {
        session_start();
    }

    //Метод возвращает массив сессии по передаваемому ключу.
    public function get($key)
    {
        return $_SESSION[$key];
    }

    //Метод добавляет в массив сесси по ключу $key значение $values.
    public function set($key, $values)
    {
        $_SESSION[$key] = $values;
    }
}