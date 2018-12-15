<?php
/**
 * Этот контроллер осуществляет функцию аутентификации пользователя на сайте.
 */

namespace app\controllers;

use app\base\App;

class AuthenticationController extends Controller
{
    //Эта функция запускается по умолчанию при нажатии на кнопку аутентификация в меню.
    public function actionIndex()
    {
        $message = '';
        //Мы делаем вызов на создание или вызова компонента request в методе  App.
        $request = App::call()->request;
        //Метод подключает сессию.
        $this->getSession();
        //Через метод post созданный в классе App мы получаем значение из параметра при отрпавке запроса
        $submit = $request->post('authentication') ?? null;
        //Если была нажата кнопка со значением authentication
        if ($submit) {
            //Помещаем в переменные значения которые получаются при отпраке запроса методом post.
            $login = $request->post('login');
            $password = $request->post('password');
            //Создание хеша для пароля
            $password = crypt($password, 'sdfasgasgsagf');
            //Происходит проверка имени и пароля в базе данных.
            $user = App::call()->user->getByLoginPass($login, $password);
            //Получаем id пользователя из базы данных.
            $id = App::call()->user->getId($login);
            //Сохраняем в сессию id пользователя для уникальной идентификации его на сайте.
            $_SESSION['id'] = $id['id'];
            //Если имя и пароль существуют в базе данных
            if ($user) {
                //в переменную помещается созданный объект одиночка для открытия сессии.
                $session = App::call()->session;
                //Мы делаем сохранение имени пользователя в сессию для отображения на сайте.
                $session->set('user_name', $login);
                //Вызывается метод для отображения приветствия аутентифицированного пользователя.
                $this->actionWelcome();
            }
            $message = 'Неправильная пара логин/пароль. Зарегестрируйтесь пожалуйста';
        }
        //Иначе происходит снова отображение страницы для аутентификации и выводится сообщение о
        //неправильно введённых данных.
        echo $this->render("authentication", ['message' => $message]);
    }

    //Метод для отображения страницы с приветствием.
    public function actionWelcome()
    {
        //Подключается сессия.
        $this->getSession();
        //Отображается страница для привествия пользователя.
        echo $this->render("welcome");
        die;
    }
}