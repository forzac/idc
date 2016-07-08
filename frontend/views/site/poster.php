<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\SendEmailForm */
/* @var $form ActiveForm */
$this->title = 'Обьявление';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if (Yii::$app->session->hasFlash('error')) {?>
    <div class="alert alert-danger">
        <?php echo Yii::$app->session->getFlash('error'); ?>
    </div>
<?php } ?>
<div class="site-poster">
    <h1><?= Html::encode($this->title) ?></h1>
    <!--    --><?php //$form = ActiveForm::begin([
    //        'action' => 'registration?mode=registration',
    //        'method' => 'post',
    //    ]); ?>
    <!---->
    <!--    --><?//= $form->field($data, 'email') ?>
    <div class="wrapper">
        <form action="poster?mode=poster" method="post">
            <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
            <label сlass="col-lg-3"> Имя</label>
            <input type="text" name="name" class="form-control"/>
            <label сlass="col-lg-3"> Описание</label>
            <input type="text" name="description" class="form-control"/>
            <div class="form-group">
                <?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
            </div>
        </form>
    </div>

    <!--    --><?php //ActiveForm::end(); ?>

</div><!-- site-sendEmail -->
