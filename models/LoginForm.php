<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $email;
    public $pass;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username и password - поля обязательные (required)
            [['email', 'pass'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // обрезаем пробелы
            //['email', 'trim'],
            ['pass', 'trim'],
            // password is проверяется особым правилом (своим) validatePassword()
            ['pass', 'validatePassword'],
        ];
    }
    
    public function attributeLabels() {
        return [
            'email' => 'E-mail',
            'pass' => 'Пароль',
            'rememberMe' => 'Запомнить',
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {   
//        Проверяем, не было ли ошибок (введены имя пользователя,пароль (function rules()))
        if (!$this->hasErrors()) {
//            если ошибок не было - создаём объект user
            $user = $this->getUser();
            
//            В противном случае, если объект юзер создать не удалось или провалена валидация
            if (!$user || !$user->validatePassword($this->pass)) {
//                выводим соответствующее сообщение об ошибке
                $this->addError($attribute, 'Не верно введён логин или пароль.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
//        Валидирует $this->validate() с помощью правил: public function rules()
        if ($this->validate()) {
            if ($this->rememberMe) {
                $user = $this->getUser();
                $user->generateHash();
                $user->save();
            }
//            Yii::$app->user->login принимает:
//            Идентификатор пользователя (который уже должен быть аутентифицирован);
//            Количество секунд, в течение которого пользователь может оставаться в 
//                    состоянии входа в систему, по умолчанию используется `0`;
//            Возвращает: bool, вошел ли пользователь в систему
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
//        Если пользователь не найден
        if ($this->_user === false) {
//            пытаемся его найти и вернуть в свойство
//            findByUsername - метод класса User
//            $this->_user = User::findByUsername($this->email);
            $this->_user = User::findByEmail($this->email);
        }
//        Возвращаем либо пользователя либо null
        return $this->_user;
    }
}
