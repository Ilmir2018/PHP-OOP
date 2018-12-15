<?php
namespace app\services;
interface IDb
{
    public function queryOne(string $sql, array $params);
    public function queryAll(string $sql, $classname, array $params);
    public function queryObject($sql, $params = [], $class);
    public function queryObjectAll($sql, $class, array $params = []);
    public function execute(string $sql, array $params= []);
}