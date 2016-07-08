<?php


return [
    'charset' => 'utf-8',
    'vendorPath' => dirname(__DIR__) . '/vendor',	
    'components' => [

        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
//        'redis' => [
//            'class' => 'yii\redis\Connection',
//            'hostname' => 'domain',
//            'port' => 6379,
//            'database' => 0,
//        ],
//
//        'session' => [
//            'class' => 'yii\redis\Session',
//        ],
        
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=local;dbname=test',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            //'useFileTransport' => false,
        ],
//        'dbLite' => [
//            'class' => 'yii\db\Connection',
//			'driverName' => 'sqlite',
//            'dsn' => 'sqlite:'.dirname(__DIR__).'/db/config',
//            'charset' => 'utf8',
//        ],
    ],

];

