<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'Login';
?>

<div class="regBox">
	<div class="boxTitle">
		<h1 class="title">admin panel</h1>
		<div class="boxLogo">
			<img src="/imgs/logotype.png" />
		</div>
	</div>
	<?php $form = ActiveForm::begin(['options' => ['class' => 'registrationForm'],]);?>
	<div class="boxInput">
		<?=$form->field($model, 'username', ['inputOptions' => ['placeholder' => 'Login',],'labelOptions' => ['class' => 'labelIcon iconLogin'],])->label('');?>
	</div>
	<div class="boxInput">
		<?=$form->field($model, 'password', ['inputOptions' => ['placeholder' => 'Password',],'labelOptions' => ['class' => 'labelIcon iconPass'],])->label('');?>
	</div>
	<div class="boxInput">
		<select class="dropdownList">
			<option>ru</option>
			<option>ua</option>
			<option>en</option>
		</select>
	</div>
	<button class="btnLogin">Login</button>
	<? ActiveForm::end();?> 	
</div>
