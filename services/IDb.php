<?php

namespace app\services;

interface IDb
{
    public function queryOne($sql, array $params = []);
    public function queryAll($sql, array $params = []);
}