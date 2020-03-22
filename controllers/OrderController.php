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

    public function actionChangedata()
    {
        $username = $this->session->get('user_name');
        $data = $this->user->getData($username);
        $id = $data['id'];
        $first_name = $data['first_name'];
        $last_name = $data['last_name'];
        if ($this->request->post('submitChangePassword') ?? null) {
            $password = $this->request->post('password');
            $this->recovery->editPassword($id, $password);
        }
        echo $this->render("changedata", ['first_name' => $first_name, 'last_name' => $last_name]);
    }
}