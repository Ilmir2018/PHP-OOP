<?php


namespace app\traits;


trait TSinglton
{
    protected static $instance = null;
    //Запрещаем создание конеструктора у объекта
    private function __construct(){}
    //Запрещаем клонирование объекта
    private function __clone(){}
    // Запрещаем создание __wakeup
    private function __wakeup(){}

    //Метод отвечающий для создания объекта от клсса Db для того чтобы
    //этот объект был один
    public static function getInstance(){
        //Если статическа переменная пустая, мы создаём текущее свойство.
        if (is_null(static::$instance)){
            static::$instance = new static(); //new static() равноценен написанию new Db();
        }
        //Еси  он уже создан, то он просто его вернёт.
        return static::$instance;
    }
}