<?php


namespace app\models\repositories;


use app\models\User;
use PHPMailer\PHPMailer\PHPMailer;

class RecoveryRepository extends Repository
{

    private $config = [];

    public function __construct($host, $SMTPAuth, $username, $password, $SMTPSecure, $port, $address, $name)
    {
        parent::__construct();
        $this->config['host'] = $host;
        $this->config['SMTPAuth'] = $SMTPAuth;
        $this->config['username'] = $username;
        $this->config['password'] = $password;
        $this->config['SMTPSecure'] = $SMTPSecure;
        $this->config['port'] = $port;
        $this->config['address'] = $address;
        $this->config['name'] = $name;
    }

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

    public function sendSMTPPassword($email, $login, $password)
    {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $this->config['host']; // Адрес SMTP сервера
        $mail->SMTPAuth = $this->config['SMTPAuth'];
        $mail->Username = $this->config['username'];
        $mail->Password = $this->config['password'];
        $mail->SMTPSecure = $this->config['SMTPSecure'];
        $mail->Port = $this->config['port'];

        $mail->setFrom($this->config['address'], $this->config['na me']);
        $mail->addAddress($email, $login);

        $mail->Subject = 'Ссылка на обновление пароля.';
        $mail->msgHTML("<html><body>
                <h1>Здравствуйте!</h1>
                <p>В этом письме содержиться временный пароль.</p>
                <p>Ваш временный пароль - {$password}</p>
                <p>Напоминаем что вы всегда можете поменять личные данные на странице http://study/order/changedata</p>
                </html></body>");

        if ($mail->send()) {
            echo 'Письмо отрпалено';
        } else {
            echo 'Ошибка: ' . $mail->ErrorInfo;
        }

    }



}