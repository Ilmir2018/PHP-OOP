<?php


namespace app\controllers;


use app\base\App;

class RecoveryController extends Controller
{

    public function actionIndex()
    {
        $messages = '';
        if ($this->request->post('submitRecoveryPass')) {
            $email = $this->request->post('email');
            $recovery = App::call()->recovery->checkEmail($email);
            if (!$recovery) echo 'Неверно указан E-mail'.'<br>';
                $id_user = $recovery['id'];
                $password = App::call()->recovery->generatePassword();
                App::call()->recovery->editPassword($id_user, $password);
                $submit = App::call()->recovery->sendEmailPassword($email, $password);
                if($submit) {
                    $messages = 'Пароль изменён и отправлен вам на почту.';
                } else {
                    $messages = 'Ошибка почтового клиента';
                }
        }

        echo $this->render("recovery-pass", ['errors' => $messages]);
    }

}