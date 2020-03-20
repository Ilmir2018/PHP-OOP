<?php


namespace app\controllers;


use app\base\App;
use app\models\repositories\UserRepository;

class RegistrationController extends Controller
{

    public function actionIndex()
    {
        if ($this->request->isPost())
        {
            $userName = $this->request->post('login');
            $firstName = $this->request->post('first_name');
            $lastName = $this->request->post('last_name');
            $email = $this->request->post('email');
            $password = $this->request->post('password');
            $this->user->saveUser($userName, $password, $firstName, $lastName, $email);
                session_start();
                $_SESSION['user_name'] = $_POST['login'];
                $this->actionCongratulations();
        }
        echo $this->render("registration");
    }

    public function actionCongratulations()
    {
        echo $this->render("congratulations");
        die;
    }

}