<?php

namespace app\models;

use Yii;
use yii\base\Model;

class Signup extends Model 
{
    public $name;
    public $email;
    public $pass;
    public $pass_repeat;
    public $verifyCode;
    
    const HASH_FILE_PATH = "registr_hash.txt";
    const EMAIL_LINK_LIFE_TIME = 48; // актуальность регистрационной ссылки (часов)
    
    public function rules() {
        return [
            [['email', 'pass', 'pass_repeat', 'name'], 'required'],
            ['name', 'string', 'min'=>2, 'max'=>15],
            ['email', 'email'],
            ['email', 'unique', 'targetClass'=>'app\models\User', 'message' => 'Такой e-mail уже занят :('],
            ['pass', 'string', 'min'=>5, 'max'=>10],
            ['pass_repeat', 'string', 'min'=>5, 'max'=>10],
            ['pass_repeat', 'compare', 'compareAttribute' => 'pass', 'message' => 'Введённый вами пароль - не совпадает с введённым паролем в поле "Повтор пароля"'],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'],
        ];
    }
    
    public function attributeLabels() {
        return [
            'name' => 'Ваше имя',
            'email' => 'E-mail',
            'pass' => 'Пароль',
            'pass_repeat' => 'Повтор пароля',
            'verifyCode' => 'Проверочный код:',
        ];
    }
    
    /*
     * Save new user
     * return bool;
     */
    public function store_registr_data() {
        //генерируем случайную строку для отправки на имэил
        $hash = $this->hashGen($this->email);

        Yii::$app->mailer->compose()
        ->setTo($this->email)
        ->setFrom('no-reply@'.Yii::$app->params['site_name'].'')
//        ->setFrom([Yii::$app->params['adminEmail']])
        ->setSubject("Регистрация на сайте ".Yii::$app->params['site_name']."")
        ->setTextBody("<p>"
            . "Для завершения регистрации, перейдите по следующей ссылке:<br>"
            . "<a href='".Yii::$app->params['site_name']."/activate/".$hash."'>".Yii::$app->params['site_name']."/activate/71".$hash."21</a>"
            . "</p>")
        ->send();
        
        // подготовка данных для записи в фаил:
        $ticket["time"] = time();
        $ticket["hash"] = $hash;
        $ticket["name"] = $this->name;
        $ticket["email"] = $this->email;
        $ticket["pass"] = $this->pass;
        $ticket = implode('|', $ticket);
        $ticket = $ticket."\r\n";
        
        if ( file_exists(self::HASH_FILE_PATH) ) {
            $file_put = file_put_contents (self::HASH_FILE_PATH , $ticket, FILE_APPEND | LOCK_EX);
        } else {
            $file_put = file_put_contents (self::HASH_FILE_PATH , $ticket);
        }
        if ($file_put === false) {
            return false;
        } else {
            return true;
        }
    }
    
    /**
     * Метод "new_user_activate(@var string)"
     * Сверяет хеш из файла (сгенерированный после получения данных из формы регистрации)
     * с хешем, полученным из ссылки предоставленной пользователю на его email для
     * подтверждения регистрации.
     * @return object\bool - случае успеха возвращает данные нового пользователя, или false.
     */
    public function check_and_save_user($hash) {
        // сверяем хеш
        if ( file_exists(self::HASH_FILE_PATH) ) {
            $hash_file_data = file ( self::HASH_FILE_PATH, FILE_IGNORE_NEW_LINES );
        } else {
            return false;
            // die('Hash file '.self::HASH_FILE_PATH.' not found!');
        }
//            debug($hash_file_data);die("---");
        foreach ($hash_file_data as $key => $value) {
            $value = explode("|", $value);
            // сравниваем хеш из файла с хешем из строки GET запроса:
            if ( array_key_exists(1 , $value) ) {
                if ($value[1] === $hash) {
                    $user = new User();
                    $user->name = $value[2];
                    $user->email = $value[3];
                    $user->pass = Yii::$app->getSecurity()->generatePasswordHash($value[4]);
                    $user->date_reg = time();
                    $user->adm_mss = 0;
                    // сохраняем данные нового пользователя
                    $user_save_result = $user->save();             
                    //чистим фаил временных хешей регистрации
                    if ( $user_save_result && ( self::hash_file_clear_line($value[1], 1)) ) {
                        
//                  Отправка письма юзеру с его логином и паролем:
                    Yii::$app->mailer->compose()
                    ->setTo($user->email)
                    ->setFrom('no-reply@'.Yii::$app->params['site_name'].'')
                    ->setSubject("Итог регистрации на сайте ".Yii::$app->params['site_name']."")
                    ->setTextBody("<p>"
                        . "Поздравляем, ".$user->name."!<br>"
                        . "Вы успешно зарегистрированы!"
                        . "Сохраните свои регистрационные данные:"
                        . "Email: ".$user->email.""
                        . "Пароль: " .$value[4].""
                        . "</p>"
                        . "Никогда не передавайте эти сведения третьим лицам!")
                    ->send();
                        return $user;
                    }
                }
            }
        }
        // если совпадения хеша отсутствуют возвращаем false
        return false;
//        die("Ошибка регистрации, повторите попытку регистрации.");
    }

    // удаление заданной строки из файла
    private static function hash_file_clear_line($id_str, $position_num_in_array) {
        if ( file_exists(self::HASH_FILE_PATH) ) {
            $hash_file_data = file(self::HASH_FILE_PATH); // array
        } else {
            return false;
        }

        $new_array = array();
        foreach ($hash_file_data as $key => $value) {
            $arr_tmp = explode("|", $value);
            $link_deadline_time = ( $arr_tmp[0] + self::EMAIL_LINK_LIFE_TIME * 3600 );
            // убираем указанную в параметрах строку а также просроченные строки по времени 
            if ( ($arr_tmp[$position_num_in_array] !== $id_str) && ( $link_deadline_time > time() ) ) {
                $new_array[] = $value;
            }
        }
        // перезаписываем данные в файле: (без указанной строки $id_str, $position_num_in_array и без просроченных)
        $file_put = file_put_contents(self::HASH_FILE_PATH , $new_array);

        if ($file_put !== false)
            return true;
        else
            return false;
    }
    
//    public function login() {
//        Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
//    }
    private function hashGen($string) {
        $salt = rand(1000, 1000000);
        $word = $salt.$string;
        // получение хэша
        $hash = md5($word);
        return $hash;//md5($hash);
    }
}