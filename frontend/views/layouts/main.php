
<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php
    // if(!isset(Yii::$app->user->identity['email'])){

    // }
 
?>
<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => 'Test Site',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);

            $menuItems = [
                ['label' => 'Home', 'url' => ['/site/index']],
            ];

            if(Yii::$app->user->isGuest):
                $menuItems[] = [
                    'label' => 'Login',
                    'url' => Url::toRoute(['/site/registration', 'mode' => 'login']),
                ];
                $menuItems[] = [
                    'label' => 'Registration',
                    'url' => Url::toRoute(['/site/registration', 'mode' => 'registration']),
                ];
                $menuItems[] = [
                    'label' => 'Емейл Рассылка',
                    'url' => Url::toRoute(['/site/registration', 'mode' => 'email']),
                ];
                $menuItems[] = [
                    'label' => 'Activate',
                    'url' => Url::toRoute(['/site/registration', 'mode' => 'activateAccount']),
                ];
//                $menuItems[] = [
//                    'label' => 'Poster',
//                    'url' => Url::toRoute(['/site/poster', 'mode' => 'poster']),
//                    'linkOptions' => ['data-method' => 'post']
//                ];
//                $menuItems[] = [
//                    'label' => 'Manager',
//                    'url' => Url::toRoute(['/site/poster', 'mode' => 'manager']),
//                    'linkOptions' => ['data-method' => 'post']
//                ];
            else:
            $menuItems[] = [
                'label' => 'Logout (' . Yii::$app->user->identity['name']  . ')',
                'url' => ['/site/registration?mode=logout'],
                'linkOptions' => ['data-method' => 'post']
            ];
            $menuItems[] = [
                'label' => 'MyAccount',
                'url' => Url::toRoute(['/site/registration', 'user_id' => Yii::$app->user->identity['id']]),
                'linkOptions' => ['data-method' => 'post']
            ];
            endif;
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems
            ]);
            NavBar::end();
        ?>

        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>

            <?php
             echo Yii::$app->session->readSession('confirm');
            ?>

            <?= $content ?>
            
        </div>

    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
