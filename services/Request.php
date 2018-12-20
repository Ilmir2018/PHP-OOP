<?php
/**
 * Created by PhpStorm.
 * User: Ilmir
 * Date: 27.10.2018
 * Time: 10:09
 */

namespace app\services;

/*
 * Класс предназначен для получения данных о запросе.
 */
use app\base\App;
use app\controllers\Controller;

class Request extends Controller
{
    //Исходное состояние.
    private $requestString;
    //Определяем переменную для имени контроллера
    private $controllerName;
    //Определяем переменную для имени адреса
    private $actionName;
    //Переменная для получения дахнных из запроса.
    private $params;

    private $requestMethod;


    public function __construct()
    {
        //Получаем данные о строке которую будем обрабатывать
        $this->requestString = $_SERVER['REQUEST_URI'];
        $this->requestMethod = $_SERVER['REQUEST_METHOD'];
        //Запускаем парсинг запроса в котором обрабатываем строку requestString.
        try {
            $this->parseRequest();
            //Перехватываем эксепшен и вызываем код написанный ниже.
        }catch (\Exception $e){
            $products = App::call()->repository->getAll();
            //Для отображения общего числа товаров в корзине
            //$cart->countBasket();
            echo $this->render("catalog", ['products' => $products]);
            //В сучае ошибки выполняется определённый код.
            echo 'Поймал';
        }
//Код выполниться в любом случае, будет ошибка или нет.
        finally{
            //echo 'sdfsdfsd';
        }
    }
    //Метод для парсинга запроса
    public function parseRequest(){
        //Делаем шаблон для адресной строки. Чтобы извлечь несколько значений, группируем шаблон ()
        //Использование в регулярных выражениях плейсхолдеров - ?P<controller>
        $pattern = "#(?P<controller>\w+)[/]?(?P<action>\w+)?[/]?[?]?(?P<params>.*)#ui";
        //Выполняем глобальный поиск шаблона в строке которую получаем в адресе. Ищем в строке
        // $this->requestString все совпадения с шаблоном $pattern и помещаем результат в массив $matches
        if(preg_match_all($pattern, $this->requestString, $matches)){
            //Записываем в переменную значение из массива, попадающее вместо значения <controller> с подмассивом 0
            $this->controllerName = $matches['controller'][0];
            //Записываем в переменную значение из массива, попадающее вместо значения <action> с подмассивом 0
            $this->actionName = $matches['action'][0];
            //Парсим параметры
            $this->params['get'] = $_GET;
            $this->params['post'] = $_POST;
        }
    }

    //Метод возвращает готовую строку образованную в parseRequest в методе App.
    public function getControllerName(){
        return $this->controllerName;
    }
    //Метод возвращает готовую строку образованную в parseRequest в методе App.
    public function getActionName(){
        return $this->actionName;
    }
    //Метод возвращает готовую строку образованную в parseRequest. Не используется.
    public function getParams(){
        return $this->params;
    }

    //Метод для быстрого получения параметра по имени.
    public function get($name){
        if (isset($this->params['get'][$name])){
            return $this->params['get'][$name];
        }
        return null;
    }
    //Метод для быстрого получения параметра по имени.
    public function post($name){
        if (isset($this->params['post'][$name])){
            return $this->params['post'][$name];
        }
        return null;
    }

    public function getRequestMethod($name){
       return $this->requestMethod;
    }

    public function isGet(){
        return $this->requestMethod == 'GET';
    }

    public function isPost(){
        return $this->requestMethod == 'POST';
    }
}