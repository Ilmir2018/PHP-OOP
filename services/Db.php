<?php
namespace app\services;



class Db
{
    //Конфигурация подключения к БД.
    private $config = [
    ];

    //Передаём данные для подключения к базе данных.
    public function __construct($driver, $host, $login, $password, $database, $charset = "utf8", $port)
    {
        $this->config['driver'] = $driver;
        $this->config['host'] = $host;
        $this->config['login'] = $login;
        $this->config['password'] = $password;
        $this->config['database'] = $database;
        $this->config['charset'] = $charset;
        $this->config['port'] = $port;

    }
    //Переменная для установки подключения к БД.
    protected $connection = null;

    //Функция для установки соединения
    protected function getConnection(){
        //Если соединения ещё нет, то устанавливаем его.
        if(is_null($this->connection)){
            //Создаём объект типа PDO и сохраняем его в $connection
            //С помощью него мы подключаемся к базе.
            $this->connection = new \PDO(
                $this->prepareDsnString(),
                $this->config['login'],
                $this->config['password']
                //array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING)
            );
            //Данные возвращаются как объект, мы устанавливаем атрибут внутри объекта.
            $this->connection->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        }
        //Иначе просто возвращаем его, чтобы не устанавливать соединение каждый раз обращаясь к базе данных.
        return $this->connection;
    }

    //Инкапсулируем логику запроса
    private function query(string $sql, array $params = []){
        //Вызываем от объекта PDO метод prepare, он возвращает объект PDOStatement
        //Этот объект содержит в себе подготовленный запрос. Он входит в библиотеку PDO.
        $pdoStatement = $this->getConnection()->prepare($sql);
        //Метод execute делает bind(привязку) автоматически
        //Чтобы выполнить запрос в базу данных мы от объекта PDO который мы получили вызываем метод execute
        $pdoStatement->execute($params);
        //Возвращается объект подготовленного запроса.
        return $pdoStatement;
    }

    //В этой функции передаём запрос и массив параметров чтобы проверит на совпадение логин и пароль в аутентификации.
    public function queryOne(string $sql, array $params = [])
    {
        return $this->query($sql, $params)->fetch();
    }

    public function queryAll(string $sql, $classname, array $params = [])
    {
        //fetchAll возвращает нам все данные из query в виде объекта.
        return $this->query($sql, $params)->fetchAll(\PDO::FETCH_CLASS, get_class($classname));
    }
    //Метод выполняет запрос и возвращает класс.
    public function queryObject($sql, $params = [], $class){
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

    //Вствляем элемент по id.
    public function lastInsertId(){
        return $this->getConnection()->lastInsertId();
    }

    //Возвращает строку для подключения к БД.
    private function prepareDsnString(): string
    {
        return sprintf("%s:host=%s;dbname=%s;charset=%s;port=%s",
            $this->config['driver'],
            $this->config['host'],
            $this->config['database'],
            $this->config['charset'],
            $this->config['port']);
    }
}