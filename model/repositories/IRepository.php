<?php
namespace app\model\repositories;
interface IRepository
{
    public function getOne($id);
    public function getAll();
    public function find($sql, $params);
    public function delete($id);
    public function getTableName();
    public function getEntityClass();
}