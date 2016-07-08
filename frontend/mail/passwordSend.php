<?php

/**
 * @var $user \app\models\User
 */
use yii\helpers\Html;

echo 'Привет '.Html::encode($email).'. ';
echo '<strong> Ваш пароль: ' . $password . '</strong> <br/>';
echo Html::a('Для смены пароля перейдите поссылке.',
    Yii::$app->urlManager->createAbsoluteUrl(
        [
            'registration?mode=resetPassword&key=' . $secret_key ,
        ]
    ));