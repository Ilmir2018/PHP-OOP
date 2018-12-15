<?php
//Через конфигурацию приложение следит чтобы мы получали одни и те же объекты.
return [
    'rootDir' => __DIR__ . "/../",
    'templatesDir' => __DIR__ . "/../views/",
    'defaultController' => 'main',
    'controllerNamespace' => "app\\controllers",
    //конфигурации компонентов, они создаются при первом запросе и возвращается всегда один и тот же объект.
    'components' => [
        'db' => [
            'class' => \app\services\Db::class,
            'driver' => 'mysql',
            'host' => 'localhost',
            'login' => 'root',
            'password' => '',
            'database' => 'litle_shop',
            'charset' => 'utf8',
            'port' => '330'
        ],
        'request' => [
            'class' => \app\services\Request::class
        ],
        'renderer' => [
            'class' => \app\services\renderers\TemplateRenderer::class
        ],
        'session' => [
            'class' => \app\services\Session::class
        ],
        'repository' => [
            'class' => \app\model\repositories\ProductRepository::class
        ],
        'user' => [
            'class' => \app\model\repositories\UserRepository::class
        ],
        'comment' => [
            'class' => \app\model\repositories\CommentRepository::class
        ],
        'order' => [
            'class' => \app\model\repositories\OrderRepository::class
        ],
        'cart' => [
            'class' => \app\model\Cart::class
        ],
        'hash' => [
            'class' => \app\model\HashPassword::class
        ]
    ]
];