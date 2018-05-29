<?php

namespace app\models;

use yii\db\ActiveRecord;

//class User extends \yii\base\BaseObject implements \yii\web\IdentityInterface
class User extends ActiveRecord implements \yii\web\IdentityInterface
{
    public static function tableName() {
        return 'user';
    }
//    public $id;
//    public $username;
//    public $password;
//    public $authKey;
//    public $accessToken;

//    private static $users = [
//        '100' => [
//            'id' => '100',
//            'username' => 'admin',
//            'password' => 'admin',
//            'authKey' => 'test100key',
//            'accessToken' => '100-token',
//        ],
//        '101' => [
//            'id' => '101',
//            'username' => 'demo',
//            'password' => 'demo',
//            'authKey' => 'test101key',
//            'accessToken' => '101-token',
//        ],
//    ];


    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
//        return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
        return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
//        foreach (self::$users as $user) {
//            if ($user['accessToken'] === $token) {
//                return new static($user);
//            }
//        }
//
//        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
//    public static function findByUsername($username)
//    {
//        return static::findOne(['email' => $username]);
////        foreach (self::$users as $user) {
////            if (strcasecmp($user['username'], $username) === 0) {
////                return new static($user);
////            }
////        }
////
////        return null;
//    }
    
    /**
     * Finds user by email
     *
     * @param string $email
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return static::findOne( ['email' => $email] );
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
//        return $this->authKey;
        return $this->hash;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($hash)
    {
//        return $this->authKey === $authKey;
        return $this->hash === $hash;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
//        return $this->password === $password;

//        Сравнивает введённый пароль и пароль в БД:
        return \Yii::$app->security->validatePassword($password, $this->pass);
        
//        Пример генерирования хеша пароля:
//        echo Yii::$app->getSecurity()->generatePasswordHash('123');
    }
    
    
    public function generateHash() {
        $this->hash = \Yii::$app->security->generateRandomString();
    }
}
