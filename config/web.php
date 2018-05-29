<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'name'=>'Code-info.ru',

    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'ru-RU',
    // подключение шаблона (глобально для всего сайта)
    'layout' => 'simplex',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
            'layout' => 'admin',
            'defaultRoute' => 'article/index',
        ],
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'Bgkdw9jnYugIG3P9466Vkpwshw4cZszu',
            // чтобы убрать web в адресе 
            'baseUrl' => '',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User', // определяем класс отвечающий за авторизацию
            'enableAutoLogin' => true,
//            указать,куда будет перенаправлен пользователь для авторизации в случае запрета в behaviors()
//            задать стр.авторизации
//            'loginUrl' => 'article',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                // переходы по страницам со статьями (пагинация)
                'category/<title:\w+>/<id:\d+>/page/<page:\d+>' => 'category/view',
                
                //'category/<id:\d+>/page/<page:\d+>' => 'category/view',
                // переходы по меню категорий (данная ссылка формируется в меню категорий)
                //'category/<id:\d+>' => 'category/view',
                'category/<title:\w+>/<id:\d+>' => 'category/view',
                'article/<title:\w+>/<id:\d+>' => 'article/view',
                'search' => 'category/search',
                // '<action:(about|contact|login|)>' => '/site/<action>',
                // '<controller>/<action>' => '<controller>/<action>',
            ],
        ],
        
    ],
    
    'controllerMap' => [
        'elfinder' => [
                'class' => 'mihaildev\elfinder\PathController',
                'access' => ['@'],
                'root' => [
                    'baseUrl'=>'/web',
//                    'basePath'=>'@webroot',
                    'path' => 'upload/global',
                    'name' => 'Files'
                ],
                'watermark' => [
                    'source'         => __DIR__.'/logo.png', // Path to Water mark image
                     'marginRight'    => 5,          // Margin right pixel
                     'marginBottom'   => 5,          // Margin bottom pixel
                     'quality'        => 95,         // JPEG image save quality
                     'transparency'   => 70,         // Water mark image transparency ( other than PNG )
                     'targetType'     => IMG_GIF|IMG_JPG|IMG_PNG|IMG_WBMP, // Target image formats ( bit-field )
                     'targetMinPixel' => 200         // Target image minimum pixel size
                ]
        ]
    ],
    
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
