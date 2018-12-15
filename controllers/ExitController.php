<?php
/**
 * Created by PhpStorm.
 * User: Ilmir
 * Date: 27.10.2018
 * Time: 16:59
 */

namespace app\controllers;


class ExitController extends Controller
{
    //Метод для выхода из авторизованного режима.
    public function actionIndex(){
        session_start();
        session_destroy();
        echo $this->render("index");
    }
}