<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\SendEmailForm */
/* @var $form ActiveForm */
$this->title = 'Емейл рассылка';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if (Yii::$app->session->hasFlash('error')) {?>
    <div class="alert alert-danger">
        <?php echo Yii::$app->session->getFlash('error'); ?>
    </div>
<?php } ?>
<div class="site-sendEmail">
    <h1><?= Html::encode($this->title) ?></h1>
    <!--    --><?php //$form = ActiveForm::begin([
    //        'action' => 'registration?mode=registration',
    //        'method' => 'post',
    //    ]); ?>
    <!---->
    <!--    --><?//= $form->field($data, 'email') ?>
    <div class="wrapper">
        <form action="registration?mode=email" method="post" class="form">
            <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
            <label сlass="col-lg-3"> Емейл</label>
                <input type="text" name="email" class="form-control"/>
            <div class="form-group">
                <input type="button" class="btn btn-warning new" value="Добавить"/>
                <input type="button" class="btn btn-warning send" value="Send"/>
                <?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
            </div>
        </form>
    </div>

    <!--    --><?php //ActiveForm::end(); ?>

</div><!-- site-sendEmail -->