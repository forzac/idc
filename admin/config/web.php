<?php

$params = array_merge(
    require(__DIR__ . '/../../config/params.php'),
    require(__DIR__ . '/params.php')
);

$config = [
    'id' => 'app-admin',
    'basePath' => dirname(__DIR__),
	'controllerNamespace' => 'admin\controllers',
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            'cookieValidationKey' => 'Qn#GzA34PkfdgcnSsf1',
        ],
	
		'user' => [
            'identityClass' => 'admin\models\User',
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
