<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\Session;
// $session = Yii::$app->session;

// $id = $data['id'];

// $url = "registration?mode=notEmail&id=$id";
/* @var $this yii\web\View */
/* @var $model app\models\SendEmailForm */
/* @var $form ActiveForm */
$this->title = 'Активация учетной записи';
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
        <form action='registration?mode=notEmail' method="post">
            <!-- <form action='registration?mode=notEmail&id=<?=$id?>' method="post"> -->
            <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
            <label сlass="col-lg-3"> Емейл</label>
            <input type="text" name="email" class="form-control"/>
            <div class="form-group">
                <?= Html::submitButton('Зарегестрироватся', ['class' => 'btn btn-success']) ?>
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
    <!--    --><?php //ActiveForm::end(); ?>

</div><!-- site-sendEmail -->