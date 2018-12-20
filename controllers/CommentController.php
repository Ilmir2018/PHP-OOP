<?php
/**
 * Created by PhpStorm.
 * User: Ilmir
 * Date: 04.11.2018
 * Time: 11:28
 */

namespace app\controllers;

use app\base\App;

class CommentController extends Controller
{
    public function actionIndex()
    {
        //Подключаем сессию, созданную при авторизации или регистрации.
        $session = App::call()->session;
        if ($session->isset('user_name')) {
            $request = App::call()->request;
            //Через метод post созданный в классе App мы получаем значение из параметра при отрпавке запроса
            $submit = $request->post('submitAddComment') ?? null;
            //Если происходит отправка запроса, происходят следующие действия.
            if ($submit) {
                //Переменная принимает значение, отправленное методом $_POST с именем content.
                $content = $request->post('content');
                //Переменная принимает значение, отправленное методом $_POST с именем name.
                $name = $request->post('name');
                //Если поля не пустые совершаем следующие действия.
                if (!empty($content) && !empty($name)) {
                    //Вызываем метод getComment из компонента comment для добавления в базу данных комментария.
                    App::call()->comment->getComment($name, $content);
                    //Делаем редирект на текущую страницу, чтобы не происходило повторной отпарвки при
                    // перезагрузке страницы.
                    $this->redirect($_SERVER['REQUEST_URI']);
                } //Если одно поле пустое, просим заполнить все поля.
                else {
                    echo 'Заполните все поля!';
                }
            }
            //Помещаем в переменную вызов метода из копонента для получения массива объектов.
            $comments = App::call()->comment->getAll();
            //Вывод метода для отображения шаблона и передача в него необходимых параметров.
            echo $this->render("comment", ['comments' => $comments]);
        }
        //Если пользоваетль не авторизован его просят авторизоваться!
        else{
            echo $this->render("entitlement");
        }
    }
}