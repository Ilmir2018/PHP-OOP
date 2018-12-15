<?php
/**
 * Created by PhpStorm.
 * User: Ilmir
 * Date: 30.10.2018
 * Time: 18:27
 */

namespace app\base;

//Класс для хранения компонентов.
class Storage
{
    //Массив в котором лежат набор объектов по ключам.
    private $items = [];

    public function set($key, $object)
    {
        $this->items[$key] = $object;
    }

    public function get($key)
    {
        //Проверяем чтобы возвращался всегда один и тот же компонент по ключу.
        if (!isset($this->items[$key])){
            //Если этого компонента нет, мы его создаём и помещаем в наш массив.
            $this->items[$key] = App::call()->createComponent($key);
        }
        //Если есть просто возвращаем.
        return $this->items[$key];
    }
}