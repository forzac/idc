<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RegForm */
/* @var $form ActiveForm */
$this->title = 'Обновление пароля';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="reg">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="wrapper">
<!--        --><?php //$form = ActiveForm::begin([
//            'action' => 'registration?mode=resetPassword&key=' . $data['key'],
//            'method' => 'post'
//        ]); ?>
<!--        <input class='eml' type="text" name="User[email]" value="--><?php //echo $data['email']; ?><!--"/>-->
<!--        --><?//= $form->field($data['model'], 'password')->passwordInput() ?>
<!--        --><?//= $form->field($data['model'], 'repeat_password')->passwordInput() ?>
<!---->
<!--        <div class="form-group">-->
<!--            --><?//= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
<!--        </div>-->
<!--        --><?php //ActiveForm::end(); ?>

        <form action="registration?mode=resetPassword&key=<?=$data['key']?>" method="post">
            <input class='eml' type="text" name="User[email]" value="<?php echo $data['email']; ?>"/>
            <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
            <label сlass="col-lg-3"> Пароль</label>
            <input type="password" name="User[password]" class="form-control"/>
            <label сlass="col-lg-3"> Пароль(повтор)</label>
            <input type="password" name="User[repeat_password]" class="form-control"/>
            <div class="form-group">
                <?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
            </div>
        </form>
    </div>
</div><!-- reg -->