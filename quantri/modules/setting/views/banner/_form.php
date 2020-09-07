<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\checkbox\CheckboxX;

?>

<div class="banner-form">
    <?php $form = ActiveForm::begin(); ?>
    <!--Tên ảnh-->
    <?= $form->field($model, 'name',['options' => ['class' => 'col-md-4']])->textInput(['maxlength' => true,'placeholder'=>'Nhập tên ảnh']) ?>
    <!--Sắp xếp-->
    <?= $form->field($model, 'order',['options' => ['class' => 'col-md-1']])->textInput(['type'=>'number','max'=>999,'placeholder'=>'0']) ?>
    <!--Up ảnh-->
    <?= $form->field($model, 'image',['options' => ['class' => 'col-md-2']])->textInput(['maxlength' => true,'id'=>'imageFile','placeholder'=>'Chọn ảnh']) ?>
    <div class="col-md-2" style="height: 80px">
        <img src="<?= (isset($model->image))? Yii::$app->request->hostInfo.'/'.$model->image:''?>" id="previewImage" alt="" style="max-width: 81%">
    </div>
    <div class="clearfix"></div>
    <!--Liên kết-->
    <?= $form->field($model, 'url',['options' => ['class' => 'col-md-6']])->textInput(['maxlength' => true,'placeholder'=>'Nhập đường dẫn liên kết với ảnh']) ?>
    <!--Thẻ Alt-->
    <?= $form->field($model, 'alt',['options' => ['class' => 'col-md-4']])->textInput(['maxlength' => true,'placeholder'=>'Seo Alt - Google đọc ảnh qua thẻ này']) ?>
    <!--Trạng thái-->
    <?= $form->field($model, 'status',['options' => ['class' => 'activeform col-md-2']])->widget(CheckboxX::classname(),
        [
        'initInputType' => CheckboxX::INPUT_CHECKBOX,
        'options'=>['value' => $model->status],
        ])->label(false);
    ?>
    <!--Nội dung-->
    <?= $form->field($model, 'content',['options' => ['class' => 'col-md-12']])->textarea(['rows' => 6,'class' => 'content']) ?>
    <div class="clearfix"></div>
    <div class="form-group btn_save">
        <?= Html::submitButton($model->isNewRecord ? ' Thêm mới ': ' Chỉnh sửa ', ['class' => 'btn btn-success btn_luu']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<?php
// $this->registerJsFile('@web/js/dichvu/addchitiet.js', ['depends' => [\yii\web\JqueryAsset::class]] );
$this->registerJsFile("@web/tinymce/tinymce.min.js", ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerJsFile("@web/js/main.js", ['depends' => [yii\web\JqueryAsset::className()]]);
?>