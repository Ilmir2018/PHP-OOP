<?php
/**
 * Created by PhpStorm.
 * User: Ilmir
 * Date: 20.10.2018
 * Time: 10:10
 */

namespace app\controllers;
use app\base\App;

class ProductController extends Controller
{

    //Метод который срабатывет при заходе в галерею.
    public function actionIndex()
    {
        //Подключаем сессию, созданную при авторизации или регистрации.
        $this->getSession();
        //Если сессия существует есть права выполнять следующие операции
        if (isset($_SESSION['user_name'])) {
            //Мы делаем вызов на создание компонента request в методе  App.
            $request = App::call()->request;
            //Мы делаем вызов на создание компонента cart в методе  App.
            $cart = App::call()->cart;
            //Через метод post созданный в классе App мы получаем значение из параметра при отрпавке запроса
            $submit = $request->post('submitAddBasket') ?? null;
            //Если была нажата кнопка со значением submitAddBasket
            if ($submit) {
                //Помещаем в переменную значение которое получается при отпраке запроса методом post.
                $productId = $request->post('id');
                //Вызываем метод addToCart из компонента cart для добавления в сессию элемента по ключу $productId.
                $cart->addToCart($productId);
                //Делаем редирект на текущую страницу, чтобы не происходило повторной отпарвки при
                // перезагрузке страницы.
                $this->redirect($_SERVER['REQUEST_URI']);
            }
            //Помещаем в переменную вызов метода из копонента для получения массива объектов.
            $products = App::call()->repository->getAll();
            //Для отображения общего числа товаров в корзине вызваем метод который возвращает сессию хранящую
            // общее количество.
            $cart->countBasket();
            //Вывод метода для отображения шаблона и передача в него необходимых параметров.
            echo $this->render("catalog", ['products' => $products]);
        }
        //Если пользоваетль не авторизован его просят авторизоваться!
        else{
            echo $this->render("entitlement");
        }
    }

    //Метод который срабатывет при переходе на конкретный товар.
    public function actionCard()
    {
        //Подключаем сессию, созданную при авторизации или регистрации.
        $this->getSession();
        //Если сессия существует есть права выполнять следующие операции
        if (isset($_SESSION['user_name'])) {
            //В переменную попадает значение полученное при выполнение запроса по ключу id.
            $id = App::call()->request->get('id');
            //В переменную попадает объект полученный по id.
            $model = App::call()->repository->getOne($id);
            //Вывод метода для отображения шаблона и передача в него необходимых параметров.
            echo $this->render("card", ['model' => $model]);
        }//Если пользоваетль не авторизован его просят авторизоваться!
        else{
            echo $this->render("entitlement");
        }
    }

}





































/*public function addToCard($goods_id, $qty = 1){
        $basket = $this->getSession2();
           //$basket = Session::getInstance()->get('basket');
        if(isset($basket[$goods_id])){
           // echo '<pre>';
            var_dump($basket[$goods_id]['cart']); //die;
            // если в массиве cart уже есть добавляемый товар
            $basket[$goods_id]['card'] += (int) $qty;
        }else{
            // если товар кладется в корзину впервые
            $basket[$goods_id]['card'] = (int) $qty;
        }
    }



    public function getSession2(){
        $session = App::call()->session;
        return $session->get('cart');
    }

}*/