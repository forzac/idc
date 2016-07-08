<?php

use yii\helpers\Html;
use yii\bootstrap\Tabs;
use yii\bootstrap\ActiveForm;
use yii\widgets\MaskedInput;
use yii\helpers\Url;
use yii\web\UploadedFile;

$user_id = Yii::$app->user->identity->attributes['user_id'];
?>

<div class="float-clear">
    <ul class="account-menu">
        <li><a href="#">MyAccount</a>
            <ul id="drop-accont-menu">
                <li><a href="myaccount/adverts" class="documents" id="1">Объявления</a></li>
                <li><a href="myaccount/posts" class="messages" id="2">Посты</a></li>
                <li><a href="myaccount/options" class="signout" id="3">Настройки</a></li>
                <li><a href="myaccount/favorites" class="favorites" id="4">Избранное</a></li>
            </ul>

        </li>
        <li><a href="#" class="last-menu">Объявление</a></li>
    </ul>
</div>
<br />
<dl class="accordion-tabs">
    <dt class="accordion__title" id="1">Объявления</dt>
    <dd class="accordion__content">
        <p>sdfsdfsdfsdfsf</p>
    </dd>
    <dt class="accordion__title" id="2">Посты</dt>
    <dd class="accordion__content">
        <p><b>Item 3 content.</b> Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Phasellus dui urna, mollis vel suscipit in, pharetra at ligula. Pellentesque a est vel est fermentum pellentesque sed sit amet dolor. Nunc in dapibus nibh. Aliquam erat volutpat. Phasellus vel dui sed nibh iaculis convallis id sit amet urna. Proin nec tellus quis justo consequat accumsan. Vivamus turpis enim, auctor eget placerat eget, aliquam ut sapien.</p>
    </dd>
    <dt class="accordion__title" id="3">Настройки</dt>
    <dd class="accordion__content" id="accordionContent">
        <!--  accordion  -->
        <dl class="accordion">
            <dt><a href="javascript:void(0);">Личные данные</a></dt>

            <dd>
<!--                --><?php //$form = ActiveForm::begin([
//                    'id' => 'personal',
//                    'options' => ['class' => 'form-horizontal', 'enctype'=>'multipart/form-data'    ],
//                    'action' => Url::to(['site/myaccount', 'mode' => 'personal']),
//                    'method' => 'post',
//                    'fieldConfig' => [
//                        'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
//                        'labelOptions' => ['class' => 'col-lg-1 control-label'],
//                    ],
//                ]); ?>
<!--                    <div class="" style="width: 100px; height: 100px; margin:0 0 20px 60px; overflow: hidden">-->
<!--                        <img src="--><?//=Url::to(['/images/frontend/avatars/'.$data->avatar])?><!--" alt="img-1" style="width: 100%">-->
<!--                    </div>-->
<!---->
<!--                    --><?//= $form->field($data, 'avatar')->fileInput() ?>
<!--                    --><?//= $form->field($data, 'name') ?>
<!--                    --><?//= $form->field($data, 'surname') ?>
<!--                    --><?//= $form->field($data, 'patronymic') ?>
<!--                    --><?//= $field = $form->field($data, 'phone')->widget(MaskedInput::className(),
//                        ['mask' => ['+99(999) 999-99-99','999 999 99 99','(999) 999 99 99']])
//                    ?>
<!---->
<!--                    <div class="form-group">-->
<!--                        <div class="col-lg-offset-1 col-lg-11">-->
<!--                            --><?//= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!--                --><?php //ActiveForm::end(); ?>

<!--                <form action = "--><?//=Url::to(['site/myaccount', 'mode' => 'personal'])?><!--" method="post" >-->
<!--                    <label for="account_name" >Имя</label>-->
<!--                    <input type="text" name="name" id="account_name"><br />-->
<!--                    <label for="account_surname" >Имя</label>-->
<!--                    <input type="text" name="name" id="account_surname">-->
<!--                    <input type="submit">-->
<!--                </form>-->

                <form action="<?=Url::to(['site/registration', 'mode' => 'personal' , 'user_id' => $user_id]) ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
                    <div class="" style="width: 100px; height: 100px; margin:0 0 20px 60px; overflow: hidden">
                        <img src="<?=Url::to(['/images/frontend/avatars/'.$data->avatar])?>" alt="img-1" style="width: 100%">
                    </div>
                    <br />
                    <input type="file" name="avatar">
                    <br />
                    <label for="name">Имя</label>
                    <input type="text" name="name" id="name" value="<?=$data->name?>"><br />
                    <label for="surname">Фамилия</label>
                    <input type="text" name="surname" id="surname" value="<?=$data->surname?>"><br />
                    <label for="patronymic">Отчество</label>
                    <input type="text" name="patronymic" id="patronymic" value="<?=$data->patronymic?>"><br />
                    <label for="phone">Телефон</label>
                    <input type="text" name="phone" id="phone" value="<?=$data->phone?>"><br />
                    <input type="submit" value="Сохранить">
                </form>
            </dd>

            <dt><a href="javascript:void(0);">Смена пароля</a></dt>
            <dd>
<!--                --><?php //$form = ActiveForm::begin([
//                    'id' => 'pass-notif',
//                    'options' => ['class' => 'form-horizontal'],
//                    'method' => 'post',
//                    'action' => Url::to(['site/myaccount', 'mode' => 'passchange']),
//                    'fieldConfig' => [
//                        'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
//                        'labelOptions' => ['class' => 'col-lg-1 control-label'],
//                    ],
//                ]); ?>
<!---->
<!--                    --><?//= $form->field($data, 'password')->passwordInput() ?>
<!--                    --><?//= $form->field($data, 'confirmPassword')->passwordInput() ?>
<!---->
<!--                    <div class="form-group">-->
<!--                        <div class="col-lg-offset-1 col-lg-11">-->
<!--                            --><?//= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!--                --><?php //ActiveForm::end(); ?>
                <form action="<?=Url::to(['site/registration', 'mode' => 'passchange', 'user_id' => $user_id]) ?>" method="post">
                    <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
                    <label for="account_password">Пароль</label>
                    <input type="password" name="password" id="account_password"><br />
                    <label for="account_password_confirm">Повторить пароль</label>
                    <input type="password" name="confirmPassword" id="account_password_confirm"><br />
                    <input type="submit" value="Сохранить">
                </form>
            </dd>

            <dt><a href="javascript:void(0);">Смена e-mail</a></dt>
            <dd>
<!--                --><?php //$form = ActiveForm::begin([
//                    'enableAjaxValidation' => true,
//                    'id' => 'email-notif',
//                    'options' => ['class' => 'form-horizontal'],
//                    'action' => Url::to(['site/myaccount', 'mode' => 'emailchange']),
//                    'fieldConfig' => [
//                        'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
//                        'labelOptions' => ['class' => 'col-lg-1 control-label'],
//                    ],
//                ]); ?>
<!---->
<!--                --><?//= $form->field($data, 'email') ?>
<!---->
<!--                <div class="form-group">-->
<!--                    <div class="col-lg-offset-1 col-lg-11">-->
<!--                        --><?//= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
<!--                    </div>-->
<!--                </div>-->
<!---->
<!--                --><?php //ActiveForm::end(); ?>

                <form action="<?=Url::to(['site/registration', 'mode' => 'emailchange', 'user_id' => $user_id]) ?>" method="post">
                    <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
                    <label for="account_email">Email</label>
                    <input type="text" name="email" id="account_email" value="<?=$data->email?>"><br />
                    <input type="submit" value="Сохранить">
                </form>
            </dd>

            <dt><a href="javascript:void(0);">E-mail уведомления</a></dt>
            <dd>
                <div class="email-notif">
<!--                --><?php //$form = ActiveForm::begin([
//                    'id' => 'email-notif',
//                    'options' => ['class' => 'form-horizontal'],
//                    'action' => Url::to(['site/myaccount', 'mode' => 'emailnotif']),
//
//                'fieldConfig' => [
//                    'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
//                    'labelOptions' => ['class' => 'col-lg-1 control-label'],
//                ],
//                ]); ?>
<!---->
<!--                    --><?//= $form->field($data, 'newComment')->checkbox() ?>
<!--                    --><?//= $form->field($data, 'delivery')->checkbox() ?>
<!--                    --><?//= $form->field($data, 'mailNotif')->checkbox() ?>
<!--                    --><?//= $form->field($data, 'answerComment')->checkbox() ?>
<!---->
<!--                    <div class="form-group">-->
<!--                        --><?//= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
<!--                    </div>-->
<!---->
<!--                --><?php //ActiveForm::end(); ?>
                    <?


                    ?>
                    <form action="<?=Url::to(['site/registration', 'mode' => 'emailnotif', 'user_id' => $user_id]) ?>" method="post" id="emailnotif">
                        <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
                        <label for="newComment">Новый коментарий</label>
                        <input type="checkbox" name="newComment" id="newComment" data="<?=$data->newComment ?>"><br />

                        <label for="delivery">Email рассылка</label>
                        <input type="checkbox" name="delivery" id="delivery" data="<?=$data->delivery ?>"><br />

                        <label for="mailNotif">Почтовые уведомления</label>
                        <input type="checkbox" name="mailNotif" id="mailNotif" data="<?=$data->mailNotif ?>"><br />

                        <label for="answerComment">Ответ на коментарий</label>
                        <input type="checkbox" name="answerComment" id="answerComment" data="<?=$data->answerComment ?>"><br />

                        <input type="submit" value="Сохранить">
                    </form>
                </div>
            </dd>

            <dt><a href="javascript:void(0);">Конфиденциальность</a></dt>
            <dd>
                <div class="confidentiality">
<!--                --><?php //$form = ActiveForm::begin([
//                    'id' => 'email-notif',
//                    'options' => ['class' => 'form-horizontal'],
//                    'action' => Url::to(['site/myaccount', 'mode' => 'confidentiality']),
//                    'fieldConfig' => [
//                        'template' => "{label}\n<div class=\"col-lg-1\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
//                        'labelOptions' => ['class' => 'col-lg-1 control-label'],
//                    ],
//                ]); ?>
<!---->
<!--                    --><?//= $form->field($data, 'confidentiality')->checkbox() ?>
<!---->
<!--                    <div class="form-group">-->
<!--                        --><?//= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
<!--                    </div>-->
<!---->
<!--                --><?php //ActiveForm::end(); ?>
                    <form action="<?=Url::to(['site/registration', 'mode' => 'confidentiality', 'user_id' => $user_id]) ?>" method="post" id="confidentiality">
                        <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
                        <label for="confidentiality">Отображать объявления, или нет?</label>
                        <input type="checkbox" name="confidentiality" id="confidentiality" data="<?=$data->confidentiality ?>"><br />

                        <input type="submit" value="Сохранить">
                    </form>
                </div>
            </dd>

        </dl>​
        <!--  accordion  -->
    </dd>
    <dt class="accordion__title" id="4">Избранное</dt>
    <dd class="accordion__content">
        <p>sdfsdfsdf</p>
    </dd>
</dl>

    <?php
//    echo Tabs::widget([
//        'items' => [
//            [
//                'label' => 'Объявления',
//                'content' => $this->render('myaccount/adverts'),
//                'active' => true,
//                'options' => [
//                'id' => 'advert'
//                 ]
//            ],
//            [
//                'label' => 'Посты',
//                'content' => $this->render('myaccount/posts'),
//                'options' => [
//                    'id' => 'posts'
//                ]
//            ],
//            [
//                'label' => 'Настройки',
//                'content' => $this->render('myaccount/options', ['model' => $data]),
//                'options' => [
//                    'id' => 'options'
//                ]
//            ],
//            [
//                   'label' => 'Избранное',
//                'content' => $this->render('myaccount/favorites'),
//                'options' => [
//                    'id' => 'favorites'
//                ]
//            ],
//        ],
//        'options' => [
//            'id' => 'tabs'
//        ]
//    ]);
    ?>
