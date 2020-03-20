<?php


namespace app\models\repositories;


use app\models\User;

class RecoveryRepository extends Repository
{

    public function getTableName()
    {
        return 'users';
    }

    public function getEntityClass()
    {
        return User::class;
    }

    public function checkEmail($email)
    {
        $table = static::getTableName();
        $sql = "SELECT * FROM {$table} WHERE email = :email";
        return static::getDb()->queryOne($sql, [':email' => $email]);
    }


    public static function editPassword($id, $password)
    {
        $table = static::getTableName();
        $sql = "UPDATE {$table} SET password = :password WHERE id = :id";
        return static::getDb()->execute($sql, [':id' => $id, ':password' => $password]);
    }

    public static function generatePassword($number = 6)
    {
        $arr = array('a','b','c','d','e','f',
            'g','h','i','j','k','l',
            'm','n','o','p','r','s',
            't','u','v','x','y','z',
            'A','B','C','D','E','F',
            'G','H','I','J','K','L',
            'M','N','O','P','R','S',
            'T','U','V','X','Y','Z',
            '1','2','3','4','5','6',
            '7','8','9','0');
        // Генерируем пароль
        $pass = "";
        for($i = 0; $i < $number; $i++)
        {
            // Вычисляем случайный индекс массива
            $index = rand(0, count($arr) - 1);
            $pass .= $arr[$index];
        }
        $hash = md5($pass);
        return $hash;
    }

    public static function sendEmailPassword($email,$password)
    {
        $fromMail = 'admin@goodnets.ru';
        $fromName = 'GOODNETS';
        $emailTo = $email;
        $subject = 'Восстановление пароля ';
        $subject = '=?utf-8?b?'. base64_encode($subject) .'?=';
        $headers = "Content-type: text/plain; charset=\"utf-8\"\r\n";
        $headers .= "From: ". $fromName ." <". $fromMail ."> \r\n";
        $body = "Ваш новый пароль был сгенерирован автоматически, настоятельно рекомендуем изменить его\n
               E-mail: $email\n
               Пароль: $password\n";
        $mail = mail($emailTo, $subject, $body, $headers, '-f'. $fromMail);
        if ($mail) return true;
        else return false;
    }



}