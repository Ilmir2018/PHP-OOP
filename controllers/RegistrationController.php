<?php
/**
 * Created by PhpStorm.
 * User: Ilmir
 * Date: 27.10.2018
 * Time: 13:49
 */

namespace app\controllers;

use app\base\App;

class RegistrationController extends Controller
{
    //Эта функция запускается по умолчанию при нажатии на кнопку регистрация в меню.
    public function actionIndex()
    {
        //Мы делаем вызов на создание компонента request в методе  App.
        $request = App::call()->request;
        //Через метод post созданный в классе App мы получаем значение из параметра при отрпавке запроса
        $submit = $request->post('registration') ?? null;
        //Если была нажата кнопка со значением registration
        if ($submit) {
            //Помещаем в переменные значения которые получаются при отпраке запроса методом post.
            $username = $request->post('login');
            $first_name = $request->post('first_name');
            $last_name = $request->post('last_name');
            $email = $request->post('email');
            $password = $request->post('password');
            //Создание хеша для пароля
            $password = crypt($password, 'sdfasgasgsagf');
            //Происходит занесение в базу данных сведений о пользователе.
            App::call()->user->registration($username, $password, $first_name, $last_name, $email);
            //в переменную помещается созданный объект одиночка для открытия сессии.
            $session = App::call()->session;
            //Получаем id пользователя из базы данных.
            $id = App::call()->user->getId($username);
            //Сохраняем в сессию id пользователя для уникальной идентификации его на сайте.
            $_SESSION['id'] = $id['id'];
            //Мы делаем сохранение имени пользователя в сессию для отображения на сайте.
            $session->set('user_name', $first_name);
            //Вызывается метод для отображения приветствия зарегестрированнного пользователя.
            $this->actionCongratulations();
        }
        //Вызывается отображение формы для регистрации.
        echo $this->render("registration");
    }

    //Метод для отображения приветствия пользоваетля.
    public function actionCongratulations()
    {
        echo $this->render("congratulations");
        die;
    }
}