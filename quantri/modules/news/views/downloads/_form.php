<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\checkbox\CheckboxX;
?>
<div class="downloads-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'name',['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true,'placeholder'=>'Nhập tên']) ?>
    <?= $form->field($model, 'link',['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true,'id'=>'imageFile','placeholder'=>'Chọn file để tải lên']) ?>
    <?= $form->field($model, 'cate_id',['options'=>['class'=>'col-md-2']])->widget(Select2::classname(), [
            'data' => $data['newsCategories'],
            'language' => 'en',
            'options' => ['placeholder' => 'Chọn'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
     ?>
     <?= $form->field($model, 'sort',['options' => ['class' => 'col-md-1']])->textInput(['placeholder'=>'0']) ?>
     <?= $form->field($model, 'status',['options' => ['class' => 'activeform col-md-1']])->widget(CheckboxX::classname(),
        [
            'initInputType' => CheckboxX::INPUT_CHECKBOX,
            'options'=>['value' => $model->status],
            'pluginOptions'=>['threeState'=>false]
        ])->label(false);
    ?>
    <div class="clearfix"></div>
    <?= $form->field($model, 'descriptions',['options' => ['class' => 'col-md-12']])->textarea(['rows' => 4,'class' => 'content']) ?>
    <div class="form-group btn_save">
        <?= Html::submitButton($model->isNewRecord ? 'Thêm mới': 'Chỉnh sửa', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<?php
// $this->registerJsFile('@web/js/dichvu/addchitiet.js', ['depends' => [\yii\web\JqueryAsset::class]] );
$this->registerJsFile("@web/tinymce/tinymce.min.js", ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerJsFile("@web/js/main.js", ['depends' => [yii\web\JqueryAsset::className()]]);
?>