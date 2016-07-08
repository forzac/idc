<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RegForm */
/* @var $form ActiveForm */
$this->title = 'Подтверждение регистрации';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reg" xmlns="http://www.w3.org/1999/html">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="wrapper">
<!--        --><?php //$form = ActiveForm::begin([
//            'action' => 'registration?mode=activateAccount&key=' . $data['key'],
//            'method' => 'post'
//        ]); ?>
<!--        <input class='eml' type="text" name="User[email]" value="--><?php //echo $data['email']; ?><!--"/>-->
<!--        --><?//= $form->field($data['model'], 'surname') ?>
<!--        --><?//= $form->field($data['model'], 'name') ?>
<!--        --><?//= $form->field($data['model'], 'patronymic') ?>
<!--        --><?//= $form->field($data['model'], 'password')->passwordInput() ?>
<!--        --><?//= $form->field($data['model'], 'repeat_password')->passwordInput() ?>
<!--        --><?//= $form->field($data['model'], 'phone') ?>
<!---->
<!--        <div class="form-group">-->
<!--            --><?//= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
<!--        </div>-->
<!--        --><?php //ActiveForm::end(); ?>

        <form action="registration?mode=activationAccount&key=<?=$data['key'] ?>" method="post">
            <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" class="form-control" />
            <input type="hidden" name="User[email]" value="<?=$data['email']?>" class="form-control" />
            <label> Имя </label>
            <input type="text" name="User[name]" value="" class="form-control" />
            <label> Фамилия </label>
            <input type="text" name="User[surname]" value="" class="form-control" />
            <label> Отчество </label>
            <input type="text" name="User[patronymic]" value="" class="form-control" />
            <label> Телефон </label>
            <input type="text" name="User[phone]" value=""  class="form-control"/>
            <label> Пароль </label>
            <input type="password" name="User[password]"  class="form-control"/>
            <label> Пароль(повтор) </label>
            <input type="password" name="User[repeat_password]"  class="form-control"/>
            <input type="submit" class="btn btn-success" value="Зарегестрироватся"/>
        </form>
    </div>

</div><!-- reg -->