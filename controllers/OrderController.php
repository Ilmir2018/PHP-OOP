<?php
/**
 * Created by PhpStorm.
 * User: Ilmir
 * Date: 04.11.2018
 * Time: 13:26
 */

namespace app\controllers;

use app\base\App;

class OrderController extends Controller
{
    public $id;

    public function actionIndex()
    {
        //Включаем сессию
        $session = App::call()->session;
        //Подключаем сессия создаваемая при авторизации или регистрации существует делаем следующее.
        if ($session->isset('user_name')) {
            //Мы делаем вызов на создание компонента request в методе  App.
            $request = App::call()->request;
            //Через метод post созданный в классе App мы получаем значение из параметра при отрпавке запроса
            $submit = $request->post('placeYourOrder') ?? null;
            //Если нажата кнопка оформить заказ
            if ($submit) {
                //Для того чтобы вывести заказы пользователя
                $this->id = $session->get('id');
                //Помещаю в переменную общую сумму заказа, сохранённую в сессии.
                $price = $session->get('cont');
                //Если сумма заказа отсутствует, тоесть равна нулю, то происходит редирект на страницу корзины
                if (empty($price)) {
                    $this->redirect('/basket');
                }
                //Удаляем из сессии сведения о корзине.
                $session->remove('basket');
                //Если всё успешно добавляем в базу данных сведения о заказе.
                App::call()->order->getOrder($this->id, $price);
                //Делаем редирект на текущую страницу, чтобы не происходило повторной отпарвки при
                // перезагрузке страницы.
                $this->redirect($_SERVER['REQUEST_URI']);
            }
            //Через метод post созданный в классе App мы получаем значение из параметра при отрпавке запроса
            //на удаление
            $submit = $request->post('deleteYourOrder') ?? null;
            //Если нажата кнопка со знпчением deleteYourOrder по id удаляем товар
            if ($submit) {
                $id = $request->post('id');
                App::call()->order->delete($id);
            }
            //Отображаю все заказы в личном кабинете.
            $orders = App::call()->order->getOrders($session->get('id'));
            echo $this->render("order", ['orders' => $orders]);
        } //Если пользоваетль не авторизован его просят авторизоваться!
        else {
            echo $this->render("entitlement");
        }
    }
}