<?php
// session_start();
use yii\helpers\Html;
use common\widgets\Alert;
use yii\widgets\ActiveForm;
use yii\web\Session;
$this->title='Change Password : '.$user->username;
?>
<br>
<br>
<div class="user-form">
	<?= Alert::widget() ?>

		<?php $form = ActiveForm::begin(['enableClientValidation' => true, 'enableAjaxValidation' => true]); ?>

		<?= $form->field($user, 'currentPassword',['options'=>['class'=>'col-md-12']])->passwordInput() ?>

		<?= $form->field($user, 'newPassword',['options'=>['class'=>'col-md-6']])->passwordInput() ?>

		<?= $form->field($user, 'newPasswordConfirm',['options'=>['class'=>'col-md-6']])->passwordInput() ?>

		<div class="form-group btn_save">
	        <?= Html::submitButton(' Update ', ['class' => 'btn btn-primary btn_luu']) ?>
	    </div>

	<?php ActiveForm::end(); ?>
</div>