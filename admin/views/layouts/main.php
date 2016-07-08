<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use admin\assets\AppAsset;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin panel</title>
	<link rel="stylesheet" type="text/css" href="/css/site.css">
	<script src="/scripts/jquery-2.1.4.min.js"></script>
	<link rel="stylesheet" type="text/css" href="/scripts/plugins/formWrap/themes/default.css">
	<link rel="stylesheet" type="text/css" href="/scripts/plugins/formWrap/themes/select_hollbars.css">
	<script src="/scripts/plugins/formWrap/init.js"></script>
	<script src="/scripts/plugins/formWrap/func.js"></script>
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<div class="wrapper">
		<header>
			<div class="boxAbsolute">
				<nav class="boxTopNav">
						<?php
            
             echo Nav::widget([
                'options' => ['class' => 'topNav'],
				'encodeLabels' => false,
                'items' => [
				[
					'label' => 'home', 
					'url' => ['/site/index'], 
					'options' => ['class' => 'itemNavagation'],
					],
				[
					'label' => 'home', 
					'url' => ['/site/index'], 
					'options' => ['class' => 'itemNavagation'],
					],
				[
					'label' => 'home', 
					'url' => ['/site/index'], 
					'options' => ['class' => 'itemNavagation'],
					],
				Yii::$app->user->isGuest ?
				[
					'label' => 'Login', 
					'url' => ['/site/login'], 
					] :
				[
					'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
					'url' => ['/site/logout'],
					'linkOptions' => ['data-method' => 'post']
					],
				
				
                ],
            ]);
             ?>
				</nav>
			</div>
		</header>
		<div id="content">
			<div class="sitebar sitebar-left">
				<div class="boxStyle"></div>
			<?php 
            
            echo Nav::widget([
                'options' => ['class' => 'mainNav'],
				'encodeLabels' => false,
                'items' => [
				[
					'label' => '<span class="titleItem">Пользователи</span>',
					'url' => ['/users'],
					'options' => ['class' => 'itemNavagation'],
					],
				
				[
					'label' => '<span class="titleItem">Настройки</span>', 
					'url' => ['/settings'], 
					'options' => ['class' => 'itemNavagation'],
					],
				[
					'label' => '<span class="titleItem">Языки</span>', 
					'url' => ['/languages'], 
					'options' => ['class' => 'itemNavagation'],
					],
				[
					'label' => '<span class="titleItem">Страницы</span>', 
					'url' => ['/pages'], 
					'options' => ['class' => 'itemNavagation'],
					],
				[
					'label' => '<span class="titleItem">Api</span>', 
					'url' => ['/api'], 
					'options' => ['class' => 'itemNavagation'],
					],
				[
					'label' => '<span class="titleItem">Расширения</span>', 
					'url' => ['/extensions'], 
					'options' => ['class' => 'itemNavagation'],
					],
                ],
            ]);


				?>
			</div>
			<div class="sitebar sitebar-right">
				<div class="boxStyle"></div>
				<?php 
            
            echo Nav::widget([
                'options' => ['class' => 'mainNav'],
				'encodeLabels' => false,
                'items' => [
				[
					'label' => '<span class="titleItem">Объявления</span>', 
					'url' => ['/offers'], 
					'options' => ['class' => 'itemNavagation'],
					],
				
				[
					'label' => '<span class="titleItem">Категории</span>', 
					'url' => ['/categories'], 
					'options' => ['class' => 'itemNavagation'],
					],
				[
					'label' => '<span class="titleItem">Заказы</span>', 
					'url' => ['/orders'], 
					'options' => ['class' => 'itemNavagation'],
					],
				[
					'label' => '<span class="titleItem">Платежи</span>', 
					'url' => ['/payments'], 
					'options' => ['class' => 'itemNavagation'],
					],
				[
					'label' => '<span class="titleItem">Реклама</span>', 
					'url' => ['/advertising'], 
					'options' => ['class' => 'itemNavagation'],
					],
				[
					'label' => '<span class="titleItem">home</span>', 
					'url' => ['/site/index'], 
					'options' => ['class' => 'itemNavagation'],
					],
                ],
            ]);


				?>
			</div>
			<main>
                    <?=$content?>
			</main>
			<!-- <div class="sitebar sitebar-right">
				<div class="boxStyle"></div>
				<ul class="mainNav">
					<li class="itemNavagation"><a href="#"></a></li>
					<li class="itemNavagation"><a href="#"></a></li>
					<li class="itemNavagation"><a href="#"></a></li>
					<li class="itemNavagation"><a href="#"></a></li>
					<li class="itemNavagation"><a href="#"></a></li>
					<li class="itemNavagation"><a href="#"></a></li>
				</ul>
			</div> -->
		</div>
	</div>
</body>
</html>