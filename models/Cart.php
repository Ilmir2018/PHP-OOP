<?php


namespace app\models;


use app\base\App;

class Cart
{

    private $count;
    private $basket;

    public function __construct()
    {
        $this->basket = App::call()->session->get('basket');
    }

    public function addToCart($productId)
    {
        if(isset($this->basket[$productId])){
            $this->basket[$productId]['qty']++;
        } else {
            $this->basket[$productId]['qty'] = 1;
        }
        App::call()->session->set('basket', $this->basket);
    }

    public function dellFromCart($productId, $qty)
    {
        if (isset($this->basket[$productId]))
        {
            $this->basket[$productId]['qty'] -= (int) $qty;
            if($this->basket[$productId]['qty'] < 0 && $_SESSION['count'] <= 0 ){
                $basket[$productId]['qty'] = 0;
                return;
            }
        }
        else {
            $this->basket[$productId]['qty'] = (int) $qty;
        }
        App::call()->session->set('basket', $this->basket);
    }


    public function countBasket()
    {
        if (!empty($this->basket)){
            for ($i=1; $i<=count($this->basket); $i++){
                $this->count += $this->basket[$i]['qty'];
            }
        }
        $_SESSION['count'] = $this->count;
    }

}