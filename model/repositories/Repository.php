<?php
/**
 * Created by PhpStorm.
 * User: Ilmir
 * Date: 26.10.2018
 * Time: 18:00
 */

namespace app\model\repositories;


use app\base\App;

abstract class Repository implements IRepository
{
    //Это переменная-ссылка на класс Db в которую мы запоминаем получение базы данных.
    private $db;

    //Класс Db выполняет функцию связи с базой данных.
    public function __construct()
    {
        //Получем объект базы данных через  метод.
        $this->db = static::getDb();
    }

    //Выборка из базы данных по одному элементу в виде объекта.
    public function getOne($id){
        $table= static::getTableName();
        $sql =  "SELECT * FROM {$table} WHERE id = :id";
        // [':id' => $id] - при передаче параметров таким образом, мы защищаемся от sql инъекций;
        return static::getDb()->queryObject($sql, [':id' => $id], $this->getEntityClass());
    }

    //Выборка из базы данных всех элементов в виде массива объектов.
    public function getAll(){
        $table = static::getTableName();
        $sql = "SELECT * FROM {$table}";
        //Данные возвращаются в виде объекта.
        return static::getDb()->queryObjectAll($sql, $this->getEntityClass());
    }

    public function find($sql, $params){
        return $this->db->queryObject($sql, $params, $this->getEntityClass());
    }

    //Функия удаления чего либо из таблицы.
    public function delete($id){
        $table = static::getTableName();
        $sql = "DELETE FROM {$table} WHERE id = :id";
        return static::getDb()->execute($sql, [':id' => $id]);
    }

    //Реализуем пинцип инверсии зависимостей. Изолируем зависимость.
    public static function getDb(){
        //Возвращаем компонент класса db.
        return App::call()->db;
    }
}