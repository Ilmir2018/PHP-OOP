<?php


namespace app\models\repositories;


use app\models\User;

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

    public function getUser($login, $password)
    {
        $table = static::getTableName();
        $sql = "SELECT * FROM {$table} WHERE login = :login AND password = :password";
        return static::getDb()->queryOne($sql, [':login' => $login, ':password' => $password]);
    }

    public function saveUser($login, $password, $first_name, $last_name, $email)
    {
        $table = static::getTableName();
        $sql = "INSERT INTO {$table} (login, password, first_name, last_name, email)
        VALUES (:login, :password, :first_name, :last_name, :email)";
        return static::getDb()->execute($sql,  [':login' => $login, ':password' => $password,
            ':first_name' => $first_name, ':last_name' => $last_name, ':email' => $email]);
    }

    public function getData($login)
    {
        $table = static::getTableName();
        $sql = "SELECT * FROM {$table} WHERE login = :login";
        return static::getDb()->queryOne($sql, [':login' => $login]);
    }

}