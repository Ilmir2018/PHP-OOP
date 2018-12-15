<?php
/**
 * Created by PhpStorm.
 * User: Ilmir
 * Date: 29.10.2018
 * Time: 18:55
 */

namespace app\model;

use app\base\App;

class Cart{

    private $count;

    //Метод для добавления товара в массив сессий.
    public function addToCart($productId)
    {
        //Открываем и создаём сессию с ключом basket для хранения колиества товаров.
        $basket = $this->getSession();
        //Если товар с передаваемым ключом есть в массиве.
        if (isset($basket[$productId])){
            //Прибавляем + 1.
            $basket[$productId]['qty']++;
        }else{
            //Если нет кладём 1.
            $basket[$productId]['qty'] = 1;
        }
        //В массив сессии по ключу basket помещаем количесвто товаров.
        App::call()->session->set('basket', $basket);
    }

    //Метод для удаления товара из массива сессий.
    public function dellToCart($productId, $qty)
    {
        //Открываем и создаём сессию с ключом basket для хранения колиества товаров.
        $basket = $this->getSession();
        //Если товар с передаваемым ключом есть в массиве.
        if (isset($basket[$productId])){
            //Отнимаем -1.
            $basket[$productId]['qty'] -= (int) $qty;
            //Проверяем чтобы при удалении количесвто товаров не уходило в минус.
            if ($basket[$productId]['qty'] < 0 && $_SESSION['count'] <= 0 ){
                $basket[$productId]['qty'] = 0;
            }
        }else{
            $basket[$productId]['qty'] = (int) $qty;
        }
        //В массив сессии по ключу basket помещаем количесвто товаров.
        App::call()->session->set('basket', $basket);
    }


    //Метод для открытия и создания сессии с ключом basket.
    public function getSession(){
        $session = App::call()->session;
        return $session->get('basket');
    }

    //Метод для отображения общего количества товаров в корзине.
    public function countBasket(){
        //Открываем и создаём сессию с ключом basket для хранения колиества товаров.
        $basket = $this->getSession();
        //Вызываем цикл в котором проходимся по колиству элементов, хранимых в сессии $_SESSION['basket'].
        for ($i=1; $i<=count($basket); $i++){
            //К переменной прибавляем все хранимые в сессии элементы.
            $this->count += $basket[$i]['qty'];
        }
        //Создаём сессию с ключом count в которую кладём количество элементов.
        $_SESSION['count'] = $this->count;
    }
}