<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username',['options'=>['class'=>'col-md-4']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fullname',['options'=>['class'=>'col-md-4']])->textInput(['maxlength' => true]) ?>

    <div class="clearfix"></div>
    <?= $form->field($model, "status",['options'=>['class'=>'col-md-4']])->widget(Select2::classname(), [
        'data' => [0 =>'-Ẩn-', 10 => 'Kích hoạt'],
        'language' => 'en',
        'options' => ['placeholder' => 'Chọn 1'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?= $form->field($model, "permission",['options'=>['class'=>'col-md-4']])->widget(Select2::classname(), [
        'data' => $authItems,
        'language' => 'en',
        'options' => ['placeholder' => 'Chọn 1'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>
    <?= (getUser()->username=='hoaimynguyen1608') ? $form->field($model, 'role',['options'=>['class'=>'col-md-4']])->textInput(['maxlength' => true]) :'' ?>

    <div class="form-group btn_save">
        <?= Html::submitButton($model->isNewRecord ? 'Thêm mới':'Cập nhật', ['class' => 'btn btn-success btn_luu']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
