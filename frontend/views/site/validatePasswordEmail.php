<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\Session;
// $id = $data['id'];
// $key = $data['key'];



$url = "registration?mode=validatePasswordEmail";
// $url = "registration?mode=validatePasswordEmail&id=$id&key=$key";
$this->title = 'Пожалуйста введите пароль';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if (Yii::$app->session->hasFlash('error')) {?>
    <div class="alert alert-danger">
        <?php echo Yii::$app->session->getFlash('error'); ?>
    </div>
<?php } ?>
<div class="site-sendEmail">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="wrapper">
        <form action='<?=$url?>' method="post">
            <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
            <label сlass="col-lg-3"> Пароль</label>
            <input type="password" name="pass" class="form-control"/>
            <div class="form-group">
                <?= Html::submitButton('Зарегестрироватся', ['class' => 'btn btn-success']) ?>
                <?= Html::a('Востановить пароль?','/registration?mode=resetPasswordMailSocial') ?>
            </div>
        </form>
    </div>
    <?php if (!Yii::$app->user->isGuest) {
        $this->registerJs('
     function windowRef(url)
    {
        window.location = url;
    }  opener.windowRef("index");
    window.close();

    ', $this::POS_LOAD, 'hello');
    } ?>


</div>
