<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = 'Войти';
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
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class='wrapper'>
<!--        --><?php //$form = ActiveForm::begin([
//            'id' => 'login-form',
//            'options' => ['class' => 'form-horizontal'],
//            'action' => 'registration?mode=login',
//            'fieldConfig' => [
//                'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
//                'labelOptions' => ['class' => 'col-lg-1 control-label'],
//            ],
//        ]); ?>
<!---->
<!--        --><?//= $form->field($data['model'], 'email') ?>
<!--        --><?//= $form->field($data['model'], 'password')->passwordInput() ?>
<!---->
<!--        --><?php //if (!Yii::$app->user->isGuest) {
//            $this->registerJs('
//     function windowRef(url)
//    {
//        window.location = url;
//    }  opener.windowRef("index");
//    window.close();
//
//    ', $this::POS_LOAD, 'hello');
//        } ?>
<!---->
<!--        <div class="form-group">-->
<!--            <div class="col-lg-offset-1 col-lg-11">-->
<!--                --><?//= Html::submitButton('Войти', ['class' => 'btn btn-success', 'name' => 'login-button']) ?>
<!--                --><?//= Html::a('Забыли пароль?','/registration?mode=resetPasswordMail') ?>
<!--            </div>-->
<!--        </div>-->
<!--        --><?php //ActiveForm::end(); ?>


        <form action="registration?mode=login" method="post">
            <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" class="form-control" />
            <label> Емейл </label>
            <input type="text" name="User[email]" value="" class="form-control" />
            <label> Пароль </label>
            <input type="password" name="User[password]" value="" class="form-control" />
            <input type="submit" class="btn btn-success" value="Отправить"/>
            <?= Html::a('Забыли пароль?','/registration?mode=resetPasswordMail') ?>
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
    <h2>Войти через соц сети.</h2>
    <div id="social">
        <a href="<?php echo $data['google'] ?>" id="google" class="social"></a>
        <a href="<?php echo $data['facebook']  ?>" id="facebook" class="social"></a>
        <a href="<?php echo $data['vk'] ?>" id="vk" class="social"></a>
        <a href="<?php echo $data['mailru'] ?>" id="mailru" class="social"></a>
        <a href="<?php echo $data['yandex'] ?>" id="yandex" class="social"></a>
        <a href="<?php echo $data['ok'] ?>" id="ok" class="social"></a>
        <a href="<?php echo $data['instagram'] ?>" id="instagram" class="social"></a>
        <a href="<?php echo $data['twitter'] ?>" id="twitter" class="social"></a>
        <a href="<?php echo $data['linkedin'] ?>" id="linkedin" class="social"></a>
    </div>


</div>
