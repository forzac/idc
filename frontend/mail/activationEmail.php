<?php

/**
 * @var $user \app\models\User
 */
use yii\helpers\Html;

if (!$id) {
    $user_url = Yii::$app->urlManager->createAbsoluteUrl(
        [
            'registration?mode=activationAccount&key=' . $secret_key,
        ]
    );
} else {
    $user_url = Yii::$app->urlManager->createAbsoluteUrl(
        [
            'registration?mode=confirm-email&key=' . $secret_key,
        ]
    );
}

echo 'Привет '.Html::encode($email).'. ';
echo Html::a('Для подтверждения регистрации перейдите по этой ссылке.',$user_url);