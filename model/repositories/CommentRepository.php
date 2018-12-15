<?php
/**
 * Created by PhpStorm.
 * User: Ilmir
 * Date: 04.11.2018
 * Time: 11:36
 */

namespace app\model\repositories;
use app\model\Comment;

//Класс для работы с данными о комментариях из таблицы comment в БД.
class CommentRepository extends Repository
{
    public function getTableName()
    {
        return 'comment';
    }

    public function getEntityClass()
    {
        return Comment::class;
    }

    //Функция добавления комментария
    public function getComment($name, $content){
        $table= static::getTableName();
        $sql = "INSERT INTO {$table} (name, content) VALUES (:name, :content)";
        return static::getDb()->execute($sql, [':name' => $name, ':content' => $content]);
    }
}