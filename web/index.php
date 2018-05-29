<?php
//var_dump($_SERVER['REQUEST_URI']); die(); // /nastroyka-veb-servera-apache2-v-ubuntu-1604/article/v/39
if( $_SERVER['REQUEST_URI'] == '/nastroyka-veb-servera-apache2-v-ubuntu-1604/article/v/39') {
    header('location:/article/настройка_веб_сервера_apache2_в_ubuntu_16_04/39', true, 301);
    exit();
}

if( $_SERVER['REQUEST_URI'] == '/ustanovka-i-nastroyka-php-v-ubuntu-1604/article/v/40') {
    header('location:/article/установка_и_настройка_php_в_ubuntu_16_04/40', true, 301);
    exit();
}

if( $_SERVER['REQUEST_URI'] == '/ustanovka-moduley-php-v-ubuntu-1604/article/v/44') {
    header('location:/article/установка_модулей_php_в_ubuntu_16_04/44', true, 301);
    exit();
}

if( $_SERVER['REQUEST_URI'] == '/ustanovka-mysql-v-ubuntu-1604/article/v/45') {
    header('location:/article/установка_mysql_в_ubuntu_16_04/45', true, 301);
    exit();
}

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';
// подключение доп.файла
require __DIR__ . '/../_my_functions.php';

$config = require __DIR__ . '/../config/web.php';

(new yii\web\Application($config))->run();
