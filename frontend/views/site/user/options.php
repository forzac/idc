<?php
/**
 * Created by PhpStorm.
 * User: ARTEM
 * Date: 18.09.2015
 * Time: 11:08
 */

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Collapse;
?>


<?php $form = ActiveForm::begin([
    'id' => 'email-notif',
    'options' => ['class' => 'form-horizontal'],
    'action' => 'user?mode=save',
//    'fieldConfig' => [
//        'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
//        'labelOptions' => ['class' => 'col-lg-1 control-label'],
//    ],
]); ?>

<?= Collapse::widget([
    'items' => [
        [
            'label' => 'Личные данные',
            'content' => $this->render('personal', ['model' => $model, 'form' => $form]),
        ],
        [
            'label' => 'Смена пароля',
            'content' => $this->render('changepass', ['model' => $model, 'form' => $form]),
            'contentOptions' => [],
            'options' => []
        ],
        [
            'label' => 'Смена email',
            'content' => $this->render('emailchange', ['model' => $model, 'form' => $form]),
            'contentOptions' => [],
            'options' => []
        ],
        [
            'label' => 'Email уведомления',
            'content' => $this->render('emailnotif', ['model' => $model, 'form' => $form]),
            'contentOptions' => [],
            'options' => []
        ],
        [
            'label' => 'Конфеденциальность',
            'content' =>  $this->render('confidentiality', ['model' => $model, 'form' => $form]),
            'contentOptions' => [],
            'options' => []
        ]
    ]
]);?>


<?php ActiveForm::end(); ?>




