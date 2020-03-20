<?php


namespace app\controllers;


use app\models\repositories\ProductRepository;

class BasketController extends Controller
{

    public function actionIndex()
    {
        $session = $this->session->get('basket');
        if($this->request->post('submitDellBasket') ?? null) {
            $id = $this->request->post('id');
            $this->cart->dellFromCart($id, 1);
            $this->redirect($this->request->getRequestString());
        }
        $baskets = $this->product->getAll();
        $arr = [];
        foreach ($baskets as $basket) {
            array_push($arr, $basket->price * $session[$basket->id]['qty']);
        }
        $this->cart->countBasket();
        $this->session->set('allSum', array_sum($arr));
        echo $this->render("basket", ['baskets' => $baskets, 'session' => $session]);
    }

}