<?php


namespace app\controllers;

use app\base\App;
use app\models\repositories\ProductRepository;

class ProductController extends Controller
{

    public function actionIndex()
    {
            $products = $this->product->getAll();
            if ($this->request->post('submitAddBasket') ?? null) {
                $productId = $this->request->post('id');
                $this->cart->addToCart($productId);
                $this->redirect($this->request->getRequestString());
            }
            $this->cart->countBasket();
            echo $this->render("catalog", ['products' => $products]);
    }

    public function actionCard() {
        $id = App::call()->request->get('id');
        $model = (new ProductRepository())->getOne($id);
        echo $this->render("card", ['model' => $model]);
    }

}