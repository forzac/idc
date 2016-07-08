<?php

/**
 * @var $user \app\models\User
 */
use yii\helpers\Html;

echo 'Привет '.Html::encode($email).'. ';
echo Html::a('Для подтверждения регистрации перейдите по этой ссылке.',
    Yii::$app->urlManager->createAbsoluteUrl(
        [
            'registration?mode=confirmEmail&user_id=' . $user_id,
        ]
    ));
