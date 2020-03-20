<?php
return [
    'rootDir' => __DIR__ . "/../",
    'templatesDir' => __DIR__ . "/../views/",
    'defaultController' => "main",
    'controllerNamespace' => "app\\controllers",
    'components' => [
        'db' => [
            'class' => \app\services\Db::class,
            'driver' => 'mysql',
            'host' => 'localhost',
            'login' => 'root',
            'password' => '',
            'database' => 'little_shop',
            'charset' => 'utf8',
            'port'=> '3307'
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
        'cart' => [
            'class' => \app\models\Cart::class
        ],
        'order' => [
           'class' => \app\models\repositories\OrderRepository::class
        ],
        'comment' => [
            'class' => \app\models\repositories\CommentRepository::class
        ],
        'user' => [
            'class' => \app\models\repositories\UserRepository::class
        ],
        'product' => [
            'class' => \app\models\repositories\ProductRepository::class
        ],
        'recovery' => [
            'class' => \app\models\repositories\RecoveryRepository::class
        ]
    ]
];