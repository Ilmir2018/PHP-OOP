<?php


namespace app\controllers;


class ExitController extends Controller
{

    public function actionIndex()
    {
        session_start();
        unset($_SESSION['user_name']);
        session_destroy();
        echo $this->render("index");
    }

}