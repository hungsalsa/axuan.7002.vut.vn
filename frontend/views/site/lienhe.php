<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
// use kartik\checkbox\CheckboxX;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\news\Contacts */
/* @var $form ActiveForm */
?>
<div class="contact">
	<div class="card">
		<div class="card-header">
			<h4 class="card-title text-center">Khách hàng liên hệ</h4>
		</div>
		<div class="card-body">
			
			<?php $form = ActiveForm::begin(); ?>

			<?= $form->field($model, 'company_name') ?>
			<?= $form->field($model, 'address') ?>
			<?= $form->field($model, 'tax_code') ?>
			<?= $form->field($model, 'manager') ?>
			<?= $form->field($model, 'phone') ?>
			<?= $form->field($model, 'business') ?>

			<?=  $form->field($model, 'gender')->radioList(
				[0 => 'Nam', 1 => 'Nữ'], 
				['custom' => true, 'inline' => true, 'id' => 'custom-radio-list-inline']
			); ?>

			<?= $form->field($model, 'birth_day')->widget(DatePicker::classname(), [
				'options' => ['placeholder' => 'Enter birth date ...'],
					'type' => DatePicker::TYPE_COMPONENT_APPEND,
					'pickerIcon' => '<i class="fas fa-calendar-alt text-primary"></i>',
					'removeIcon' => '<i class="fas fa-trash text-danger"></i>',
				'options' => [
				],
				'pluginOptions' => [
					'autoclose'=>true,
					'autoclose'=>true,
					'format' => 'mm/dd/yyyy'
				]
			]); ?>

			<?= $form->field($model, 'date_bussiness')->widget(DatePicker::classname(), [
				'options' => ['placeholder' => 'Enter birth date ...'],
					'type' => DatePicker::TYPE_COMPONENT_APPEND,
					'pickerIcon' => '<i class="fas fa-calendar-alt text-primary"></i>',
					'removeIcon' => '<i class="fas fa-trash text-danger"></i>',
				'options' => [
				],
				'pluginOptions' => [
					'autoclose'=>true,
					'autoclose'=>true,
					'format' => 'mm/dd/yyyy'
				]
			]); ?>

			<?= $form->field($model, 'email') ?>
			<?= $form->field($model, 'website') ?>

			<div class="form-group">
				<?= Html::submitButton('Đăng ký', ['class' => 'btn btn-primary']) ?>
			</div>
			<?php ActiveForm::end(); ?>


		</div>
	</div>

</div><!-- contact -->