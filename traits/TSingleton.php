<?php
namespace app\traits;

//Паттерн проетироания - Синглтон.
trait TSingleton
{
    protected static $instance = null;
    //Запрещаем создание конеструктора у объекта
    private function __construct(){}
    //Запрещаем клонирование объекта
    private function __clone(){}
    // Запрещаем создание __wakeup
    private function __wakeup(){}

    //Метод отвечающий за создания объекта от клсса вызываемого класса для того чтобы
    //этот объект был один
    public static function getInstance(){
        //Если статическа переменная пустая, мы создаём текущее свойство.
        if (is_null(static::$instance)){
            static::$instance = new static(); //new static() равноценен написанию new Db() например или зоднанию
            //любого другого объекта;
        }
        //Если  он уже создан, то он просто его вернёт.
        return static::$instance;
    }
}