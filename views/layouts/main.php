<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/style.css">
    <title>Document</title>
</head>
<body>
<h1 class="welcome">Добро пожаловать на наш сайт!</h1>
<nav>
    <ul><a href="http://untitled/main">
            <li>Главная</li>
        </a><a href="http://untitled/authentication">
            <li>Войти</li>
        </a><a href="http://untitled/registration">
            <li>Регистрация</li>
        </a></ul>
</nav>
<div class="center"><?=$content?></div>
<footer>
    <h3>Магазин одежды, выбирай что хочешь!</h3>
</footer>
</body>
</html>