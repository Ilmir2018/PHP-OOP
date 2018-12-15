<?php
/**
 * Created by PhpStorm.
 * User: Ilmir
 * Date: 27.10.2018
 * Time: 22:42
 */

namespace app\model\repositories;

use app\model\Order;

//Класс для работы с данными о заказе из таблицы orders в БД.
class OrderRepository extends Repository
{
    public function getTableName()
    {
        return 'orders';
    }

    public function getEntityClass()
    {
        return Order::class;
    }


    public function getOrders($user_id) {
        $table= static::getTableName();
        $sql = "SELECT * FROM {$table} WHERE user_id = :user_id";
        return static::getDb()->queryObjectAll($sql, $this->getEntityClass(), [':user_id' => $user_id]);
    }

    //Функция добаления нового заказа в таблицу заказов.
    public function getOrder($user_id, $price){
        $table= static::getTableName();
        $sql = "INSERT INTO {$table} (user_id, price) VALUES (:user_id, :price)";
        return static::getDb()->execute($sql, [':user_id' => $user_id, ':price' => $price]);
    }
}