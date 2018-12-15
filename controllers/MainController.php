<?php
/**
 * Created by PhpStorm.
 * User: Ilmir
 * Date: 26.10.2018
 * Time: 17:03
 */

namespace app\controllers;

class MainController extends Controller
{
    //Метод для отображения главной страницы сайта.
        public function actionIndex(){
            $this->getSession();
            echo $this->render("index");
    }
}