<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\checkbox\CheckboxX;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model quantri\modules\setting\models\SettingTabs */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="setting-tabs-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name',['options' => ['class' => 'col-md-5']])->textInput(['maxlength' => true,'placeholder' => 'để trống lấy tên theo danh mục']) ?>

    <?= $form->field($model, 'link_cate',['options' => ['class' => 'col-md-5']])->widget(Select2::classname(), [
            'data' => $dataLinkCat,
            'language' => 'en',
            'options' => ['placeholder' => 'Select Category link'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>
    <?= $form->field($model, 'status',['options' => ['class' => 'activeform col-md-1']])->widget(CheckboxX::classname(),
        [
        'initInputType' => CheckboxX::INPUT_CHECKBOX,
        'options'=>['value' => $model->status],
        ])->label(false);
    ?>

    <div class="form-group btn_save">
        <?= Html::submitButton($model->isNewRecord ? 'Thêm mới':'Chỉnh sửa', ['class' => 'btn btn-success btn_luu']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
