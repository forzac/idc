<?php
use yii\helpers\Html;
?>

<?= $form->field($model, 'name') ?>

<?= $form->field($model, 'surname') ?>

<?= $form->field($model, 'patronymic') ?>

<?= $form->field($model, 'phone') ?>


<div class="form-group">
    <div class="col-lg-offset-1 col-lg-11">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
    </div>
</div>