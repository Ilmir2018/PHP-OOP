<?php
/**
 * Created by PhpStorm.
 * User: Ilmir
 * Date: 27.10.2018
 * Time: 16:11
 */

namespace app\model\repositories;

use app\model\User;

//Класс для получения данных о пользователе из таблицы users в БД.
class UserRepository extends Repository
{
    public function getTableName()
    {
        return 'users';
    }

    public function getEntityClass()
    {
        return User::class;

    }

    //Метод для получения id пользователя. (это для заказа)
    public function getId($login)
    {
        $table = static::getTableName();
        $sql = "SELECT id FROM {$table} WHERE login = :login";
        return static::getDb()->queryOne($sql, [':login' => $login]);
    }

    //Выборка из базы данных пользователя по логну и паролю
    public function getByLoginPass($login, $password)
    {
        $table = static::getTableName();
        $sql = "SELECT * FROM {$table} WHERE login = :login AND password = :password";
        return static::getDb()->queryOne($sql, [':login' => $login, ':password' => $password]);
    }

    //Функция добавления нового пользователя в БД при регистрации
    public function registration($login, $password, $first_name, $last_name, $email)
    {
        $table = static::getTableName();
        $sql = "INSERT INTO {$table} (login, password, first_name, last_name, email)
         VALUES (:login, :password, :first_name, :last_name, :email)";
        return static::getDb()->execute($sql, [':login' => $login, ':password' => $password,
            ':first_name' => $first_name, ':last_name' => $last_name, ':email' => $email]);
    }
}