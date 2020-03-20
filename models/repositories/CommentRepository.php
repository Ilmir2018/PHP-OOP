<?php


namespace app\models\repositories;


use app\models\Comment;

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

    public function getComment($name, $content)
    {
        $table = static::getTableName();
        $sql = "INSERT INTO {$table} (name, content) VALUES (:name, :content)";
        return static::getDb()->execute($sql, [':name' => $name, ':content' => $content]);
    }
}