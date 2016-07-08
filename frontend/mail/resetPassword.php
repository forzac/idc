<?php
/**
 * @var $user \app\models\User
 */
use yii\helpers\Html;

echo 'Привет '.Html::encode($email).'. ';
echo Html::a('Для смены пароля перейдите по этой ссылке.',
    Yii::$app->urlManager->createAbsoluteUrl(
        [
            'registration?mode=resetPassword&key=' . $secret_key ,
        ]
    ));