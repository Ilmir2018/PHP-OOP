<?php


namespace app\controllers;


use app\base\App;

class OrderController extends Controller
{
    public function actionIndex()
    {
        if ($this->request->post('placeYourOrder') ?? null) {
            $id = $this->session->get('user_id');
            $price = $this->session->get('allSum');
            $this->session->remove('basket');
            $this->order->insertOrder($id, $price);
            $this->redirect($this->request->getRequestString());
        }
        if ($this->request->post('deleteYourOrder') ?? null) {
            $id = $this->request->post('id');
            $this->order->delete($id);
        }
        $orders = $this->order->getOrders($this->session->get('user_id'));
        $this->render("orders", ['orders' => $orders]);
    }
}