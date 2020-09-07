<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\checkbox\CheckboxX;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model quantri\modules\setting\models\SettingCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="setting-category-form">

    <?php $form = ActiveForm::begin(['enableAjaxValidation' => true]); ?>


    <?= $form->field($model, 'name',['options' => ['class' => 'col-md-6']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parent_id',['options' => ['class' => 'col-md-3']])->widget(Select2::classname(), [
        'data' => $dataSetCate,
        'language' => 'en',
        'options' => ['placeholder' => 'Select a Menu ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?= $form->field($model, 'link_cate',['options' => ['class' => 'col-md-3']])->widget(Select2::classname(), [
        'data' => $dataLinkCat,
        'language' => 'en',
        'options' => ['placeholder' => 'Select a Menu ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>
    <div class="clearfix"></div>
    <?= $form->field($model, 'title',['options' => ['class' => 'col-md-6']])->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'order',['options' => ['class' => 'col-md-2']])->textInput(['type'=>'number']) ?>

    <?= $form->field($model, 'status',['options' => ['class' => 'activeform col-md-1']])->widget(CheckboxX::classname(),
        [
            'initInputType' => CheckboxX::INPUT_CHECKBOX,
            'options'=>['value' => $model->status],
        ])->label(false);
        ?>

        <div class="clearfix"></div>

        <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

        <?php // $form->field($model, 'icon',['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true,'id'=>'imageFile','placeholder'=>'Click chọn ảnh']) ?>
        <div class="col-md-1" style="height: 80px">
            <img src="<?= (isset($model->icon))? Yii::$app->request->hostInfo.'/'.$model->icon:''?>" id="previewImage" alt="" style="height: 100%">
        </div>


        <div class="clearfix"></div>


        <div class="form-group">
            <?= Html::submitButton('Lưu', ['class' => 'btn btn-success']) ?>
            <?= Html::a('Hủy', ['index'], ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
