<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RegForm */
/* @var $form ActiveForm */
$this->title = 'Сброс пароля';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if (Yii::$app->session->hasFlash('success')) { ?>
    <div class="alert alert-success">
        <?php echo Yii::$app->session->getFlash('success'); ?>
    </div>
<?php } elseif (Yii::$app->session->hasFlash('error')) {?>
    <div class="alert alert-danger">
        <?php echo Yii::$app->session->getFlash('error'); ?>
    </div>
<?php } ?>
<div class="reg">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="wrapper">
        <!--        --><?php //$form = ActiveForm::begin([
        //            'action' => 'registration?mode=resetPasswordMail',
        //            'method' => 'post'
        //        ]); ?>
        <!---->
        <!--        --><?//= $form->field($data['model'], 'email') ?>
        <!---->
        <!--        <div class="form-group">-->
        <!--            --><?//= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
        <!--        </div>-->
        <!--        --><?php //ActiveForm::end(); ?>

        <form action="registration?mode=resetPasswordMail" method="post">
            <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />

            <label сlass="col-lg-3"> Емейл</label>
            <input type="text" name="User[email]" class="form-control"/>

            <div class="form-group">
                <?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
            </div>
        </form>

    </div>

</div><!-- reg -->