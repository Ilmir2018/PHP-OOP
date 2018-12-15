<?php
$config = include $_SERVER['DOCUMENT_ROOT'] . "/../config/main.php";
//Подгружаем файлы через composer
include $_SERVER['DOCUMENT_ROOT'] . "/../vendor/autoload.php";
//include ROOT_DIR . "services/Autoloader.php";
//spl_autoload_register([new app\services\Autoloader(), 'loadClass']); //Автозагрузчик. Методом является loadClass
// а создаваемый объект - new Autoloader();

//Вызываем метод в который приходит массив конфигурации с компонентами внутри.
\app\base\App::call()->run($config);


//Как в одном месте обрабатывать эксепшены от разных классов.






















