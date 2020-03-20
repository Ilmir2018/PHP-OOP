<?php


namespace app\base;


use app\traits\TSinglton;

/**
 * Class App
 * @package app\base
 * @property $db;
 * @property $request
 */

class App
{

    use TSinglton;

    public static function call()
    {
        return static::getInstance();
    }

    public $config;
    private $components;

    public function run($config)
    {
        $this->config = $config;
        $this->components = new Storage();
        $this->runController();
    }

    private function runController()
    {

        $controllersName = $this->request->getControllerName() ?: $this->config['defaultController'];
        $actionName = $this->request->getActionName();

        $controllersClass = $this->config['controllerNamespace'] . "\\" . ucfirst($controllersName) . "Controller";
        if (class_exists($controllersClass)) {
            $controller = new $controllersClass(new \app\services\renderers\TemplateRenderer());
            $controller->run($actionName);
        }
    }

    public function createComponent($key)
    {
        if (isset($this->config['components'][$key])){
            $params = $this->config['components'][$key];
            $class = $params['class'];
            if (class_exists($class)){
                unset($params['class']);
                $reflection = new \ReflectionClass($class);
                return $reflection->newInstanceArgs($params);
            } else {
                throw new \Exception("Не определён класс компонента!");
            }
        } else {
            throw new \Exception("Компонент {$key} не найден!");
        }

    }

    public function __get($name)
    {
       return $this->components->get($name);
    }

}