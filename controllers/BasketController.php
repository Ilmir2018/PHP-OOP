<?php
/**
 * Created by PhpStorm.
 * User: Ilmir
 * Date: 29.10.2018
 * Time: 11:24
 */

namespace app\controllers;
use app\base\App;

class BasketController extends Controller
{
    public function actionIndex(){
        //Подключаем сессию, созданную при авторизации или регистрации.
        $session = App::call()->session;
        //Метод подключает сессию для передачи количества товаров по ключу.
        $data = $this->getData();
        //Если сессия существует есть права выполнять следующие операции
        if ($session->isset('user_name')) {
            //Мы делаем вызов на создание компонента request в методе  App.
            $request = App::call()->request;
            //Мы делаем вызов на создание компонента cart в методе  App.
            $cart = App::call()->cart;
            //Через метод post созданный в классе App мы получаем значение из параметра при отрпавке запроса
            $submit = $request->post('submitDellBasket') ?? null;
            //Если была нажата кнопка со значением submitDellBasket
            if ($submit) {
                //Помещаем в переменную значение которое получается при отпраке запроса методом post.
                $id = $request->post('id');
                //Вызываем метод dellToCart из компонента cart для удаления элемента из сессии по ключу $productId.
                $cart->dellToCart($id, 1);
                //Делаем редирект на текущую страницу, чтобы не происходило повторной отпарвки при
                // перезагрузке страницы.
                $this->redirect($_SERVER['REQUEST_URI']);
            }
            //Помещаем в переменную вызов метода из копонента для получения массива объектов.
            $baskets = (App::call()->repository)->getAll();
            //Считаем обшщую сумму заказа
            $arr = [];
            foreach ($baskets as $basket) {
                array_push($arr, $basket->price * $data[$basket->id]['qty']);
            }
            //Подсчитываем сумму элементов в массиве.
            $arr2 = array_sum($arr);
            //В сессию помещаем общую сумму заказа.
            $session->set('cont', $arr2);
            //Для отображения общего числа товаров в корзине вызваем метод который возвращает сессию хранящую
            // общее количество.
            $cart->countBasket();
            //Вывод метода для отображения шаблона и передача в него необходимых параметров.
            echo $this->render("basket", ['baskets' => $baskets, 'data' => $data]);
        }
        //Если пользоваетль не авторизован его просят авторизоваться!
        else{
            echo $this->render("entitlement");
        }
    }
}