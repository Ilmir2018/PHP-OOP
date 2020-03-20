<?php


namespace app\controllers;
use app\base\App;
use app\models\repositories\UserRepository;
use app\models\User;

class AuthenticationController extends Controller
{

    public function actionIndex() {
        $message = '';
        if($this->request->post('authentication')) {
            $login = $this->request->post('login');
            $password = $this->request->post('password');
            $user =  $this->user->getUser($login, $password);
            if($user) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $_POST['login'];
                $this->actionWelcome();
            }
            $message = 'Неправильная пара логин/пароль. Зарегестрируйтесь пожалуйста';
        }
        echo $this->render("authentication", ['message' => $message]);
    }

    public function actionWelcome() {
        echo $this->render("welcome");
        die;
    }

}