<?php
$config = include $_SERVER['DOCUMENT_ROOT'] . "/../config/main.php";
//include ROOT_DIR . "services/Autoloader.php";
include $_SERVER['DOCUMENT_ROOT'] . "/../" . "vendor/autoload.php";

\app\base\App::call()->run($config);