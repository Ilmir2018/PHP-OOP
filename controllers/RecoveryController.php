<?php


namespace app\controllers;


use app\base\App;

class RecoveryController extends Controller
{

    public function actionIndex()
    {
        $message = '';
        if ($this->request->post('submitRecoveryPass')) {
            $email = $this->request->post('email');
            $login = $this->request->post('name');
            $recovery = $this->recovery->checkEmail($email);
            if (!$recovery) echo 'Неверно указан E-mail'.'<br>';
                $id_user = $recovery['id'];
                $password = App::call()->recovery->generatePassword();
                $this->recovery->editPassword($id_user, $password);
                $submit = $this->recovery->sendSMTPPassword($email, $login, $password);
                if($submit) {
                    $message = 'Пароль изменён и отправлен вам на почту.';
                    echo $this->render("authentication", ['message' => $message]);
                    die;
                } else {
                    $message = 'Ошибка почтового клиента';
                }
        }

        echo $this->render("recovery-pass", ['message' => $message]);
    }

}