<?php

namespace app\services;

use app\traits\TSinglton;

class Db
{

    //Подключение к базе нужно делать только одно.
    // Соединение нужно устанавливать в тот момент когда происходит
    //первый запрос к базе.
    private $config = [
    ];

    //Переменная для подключения к БД.
    protected $conn = null;

    public function __construct($driver, $host, $login, $password, $database, $charset, $port)
    {
        $this->config['driver'] = $driver;
        $this->config['host'] = $host;
        $this->config['login'] = $login;
        $this->config['password'] = $password;
        $this->config['database'] = $database;
        $this->config['charset'] = $charset;
        $this->config['port'] = $port;
    }

    public function getConnection()
    {
        //Чтобы не устанавливать каждый раз новое соединение мы проверяем
        //Если соединения ещ нет, то мы его устанавливаем, иначе я его просто возвращаю.
        if (is_null($this->conn)) {
            $this->conn = new \PDO(
                $this->prepareDsnString(),
                $this->config['login'],
                $this->config['password']
            );
            $this->conn->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        }
        //Если соедиенение уже установлено мы его просто возвращаем.
        return $this->conn;
    }

    private function query(string $sql, array $params = []){
        //Вызываем от объекта PDO метод prepare, он возвращает объект PDOStatement
        $pdoStatement = $this->getConnection()->prepare($sql);
        //Метод execute делает bind(привязку) автоматически
        $pdoStatement->execute($params);
        //Возвращается объект подготовленного запроса.
        return $pdoStatement;
    }

    public function queryOne(string $sql, array $params = [])
    {
        return $this->query($sql, $params)->fetch();
    }

    public function queryAll(string $sql, array $params = [])
    {
        //fetchAll возвращает нам все данные из query в виде объекта.
        return $this->query($sql, $params)->fetchAll(\PDO::FETCH_CLASS);
    }

    public function queryObject($sql, $params = [], $class)
    {
        $smtp = $this->query($sql, $params);
        $smtp->setFetchMode(\PDO::FETCH_CLASS, $class);
        return $smtp->fetch();
    }

    //Метод выполняет запрос и возвращает класс.
    public function queryObjectAll($sql, $class, array $params = []){
        $smtp = $this->query($sql, $params);
        $smtp->setFetchMode(\PDO::FETCH_CLASS, $class);
        return $smtp->fetchAll();
    }

    //Функция для выполнения запросов без выборки. - DELETE, UPDATE, CREATE
    public function execute(string $sql, array $params= []) {
        $this->query($sql, $params);
    }

    public function lastInsertId()
    {
        return $this->getConnection()->lastInsertId();
    }

    private function prepareDsnString(): string
    {
        //mysql:host=$host;dbname=$db;charset=$charset
        return sprintf("%s:host=%s;dbname=%s;charset=%s;port=%s",
            $this->config['driver'],
            $this->config['host'],
            $this->config['database'],
            $this->config['charset'],
            $this->config['port']);
    }

}