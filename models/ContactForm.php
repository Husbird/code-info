<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $subject;
    public $body;
    public $verifyCode;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'subject', 'body'], 'required'],

            // email has to be a valid email address
            ['email', 'email'],

            // обрезаем пробелы
            ['body', 'trim'],

            // делаем поле безопастным (без какой либо ещё валидации)
            //['body', 'safe'],

            // диапазон кол-ва символов для текстового поля
            ['body', 'string', 'length' => [5,2000]],

            // применяем собственные правила к полю
            //['body', 'myRule'],

            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    public function contact($email)
    {
        // Валидация и отправка данных на имэил
        if ($this->validate()) {
            Yii::$app->mailer->compose()
                ->setTo($email)
                ->setFrom([$this->email => $this->name])
                ->setSubject($this->subject)
                ->setTextBody($this->body)
                ->send();

            return true;
        }
        return false;
    }

    // собственное правило валидации 
    public function myRule($attr) {
        // Пример: поле принимает только ivan или ivanov
        if ( !in_array($this->$attr, ['ivan', 'ivanov']) ) {
            // в слечае несоответствия - задаём текст выводимой ошибки
            $this->addError($attr, 'Wrong!!!!');
        }
    }
}
