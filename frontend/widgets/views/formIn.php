<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<section class="form"  id="submitForm">
	<div class="form-title">
		<h2><?//= $name ?>Đăng ký tư vấn</h2>
	</div>
	<div class="form-custom">
		<div class="custom-content"><?= $content ?></div>
	</div>
	<div class="form-content">
			<?php $form = ActiveForm::begin(['enableClientValidation' => true, 'enableAjaxValidation' => false]); ?>
			<div class="form-content-2">
				<?= $form->field($model, 'fullname',['options'=>['class'=>'col-md-12']])->textInput(['maxlength' => true,'value' => isset($post['fullname']) ? $post['fullname'] : null,'placeholder' => 'Họ tên*'])->label(false) ?>
				<?= $form->field($model, 'phone',['options'=>['class'=>'col-md-12']])->textInput(['maxlength' => true,'value' => isset($post['phone']) ? $post['phone'] : null,'placeholder' => 'Điện thoại*'])->label(false) ?>
				<?= $form->field($model, 'email',['options'=>['class'=>'col-md-12']])->textInput(['maxlength' => true,'value' => isset($post['email']) ? $post['email'] : null,'placeholder' => 'Email'])->label(false) ?>
				<?= $form->field($model, 'note',['options'=>['class'=>'col-md-12']])->textarea(['rows' => 4,'placeholder' => 'Nội dung'])->label(false) ?>
			</div><br>
			<div class="form-group">
				<?= Html::submitButton($model->isNewRecord ? 'Liên hệ': 'Chỉnh sửa', ['class' => 'btn btn-success']) ?>
			</div>
		<?php ActiveForm::end(); ?>
	</div>
</section>