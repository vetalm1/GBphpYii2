<?php

$params = require __DIR__ . '/params.php';
$db =file_exists(__DIR__.'/db_local.php')?
    (require __DIR__ . '/db_local.php'):
    (require __DIR__ . '/db.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'language'=>'ru_RU',  // языковой пакет, русифицировали текст опиания ошибки валидации формы
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'activity'=>['class'=>\app\components\ActivityComponent::class , 'modelClass' => \app\models\Activity::class], // настроили новый компонент, теперь можем к нему обращаться
        'day'=>['class'=>\app\components\DayComponent::class , 'modelClass' => \app\models\Day::class],
        'dao'=>['class'=>\app\components\DAOComponent::class],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'usy5eFf1iDA_yMSSqzAidAO4mGzEr1tc',
        ],

        'rbac'=>['class' => \app\components\RbacComponent::class], // компонент рбак
        'authManager'=> ['class' => 'yii\rbac\DbManager'],
        'auth'=> ['class'=> \app\components\AuthComponent::class], // компонент авторизации

        'cache' => [
            //'class' => 'yii\caching\FileCache',
            'class' => 'yii\caching\MemCache',
            'useMemcached' => true
        ],
        'user' => [
            'identityClass' => 'app\models\Users',  // класс который отвечает за identity interface изменили на наш
            'enableAutoLogin' => true,
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
        // что бы было по ЧПУ ---------------------
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],

    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['*'], //дебаг
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['*'], // включение генератора кода
    ];
}

return $config;
