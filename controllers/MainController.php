<?php


namespace app\controllers;


class MainController extends Controller
{

    public function actionIndex()
    {
        session_start();
        echo $this->render("index");
    }

}