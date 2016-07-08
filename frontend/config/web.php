<?php

$params = array_merge(
    require(__DIR__ . '/../../config/params.php'),
    require(__DIR__ . '/params.php')
);

$config = [
    'id' => 'app-frontend',
    'charset' => 'utf-8',
    'basePath' => dirname(__DIR__),
	'controllerNamespace' => 'frontend\controllers',
    'bootstrap' => ['log'],
    'components' => [
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => 'localhost',
            'port' => 6379,
            'database' => 0,
        ],

        'session' => [
            'class' => 'yii\redis\Session',
        ],

        'mongodb' => [
            'class' => 'yii\mongodb\Connection',
            'dsn' => 'mongodb://root:password@localhost:27017/admin',
        ],

        'request' => [
            'cookieValidationKey' => 'Qn#GzA34PkfdgcnSsf1',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            //'useFileTransport' => false,
        ],
	
		'user' => [
            'identityClass' => 'frontend\models\User',
            'enableAutoLogin' => true,
        ],
        
		'errorHandler' => [
         'errorAction' => 'site/error',
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
		
		'urlManager' => [
			'enablePrettyUrl' => true,
			'enableStrictParsing' => false,
			'showScriptName' => false,
			'rules' => [
				"/" => "site/index",
				"/<action:[a-z0-9\-]{3,50}>" => "site/<action>",
			],
		]
     
    ],
    'params' => $params,
];
//main-local front
if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
