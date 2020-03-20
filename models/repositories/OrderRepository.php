<?php


namespace app\models\repositories;


use app\models\Order;

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

    public function insertOrder($user_id, $price)
    {
        $table = static::getTableName($user_id, $price);
        $sql = "INSERT INTO {$table} (user_id, price) VALUES (:user_id, :price)";
        return static::getDb()->execute($sql, [':user_id' => $user_id, ':price' => $price]);
    }

    public function getOrders($user_id)
    {
        $table = static::getTableName();
        $sql = "SELECT * FROM {$table} WHERE user_id = :user_id";
        return static::getDb()->queryObjectAll($sql, $this->getEntityClass(), [':user_id' => $user_id]);
    }

}