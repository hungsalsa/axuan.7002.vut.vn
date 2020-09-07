<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\checkbox\CheckboxX;

/* @var $this yii\web\View */
/* @var $model quantri\modules\setting\models\SettingBrands */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="setting-brands-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'name',['options' => ['class' => 'col-md-4']])->textInput(['maxlength' => true,'placeholder'=>'Nhập tên']) ?>
    <?= $form->field($model, 'alt',['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true,'placeholder'=>'Seo Alt - Google đọc ảnh qua thẻ này']) ?>
    <?= $form->field($model, 'image',['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true,'id'=>'imageFile','placeholder'=>'Chọn ảnh']) ?>
    <div class="col-md-2" style="height: 80px">
        <img src="<?= (isset($model->image))? Yii::$app->request->hostInfo.'/'.$model->image:''?>" id="previewImage" alt="" style="height: 81%">
    </div>
    <div class="clearfix"></div>
    <?= $form->field($model, 'link',['options' => ['class' => 'col-md-5']])->textInput(['maxlength' => true,'placeholder'=>'Nhập liên kết ảnh nếu có']) ?>
    <?= $form->field($model, 'order',['options' => ['class' => 'col-md-2']])->textInput(['type'=>'number','placeholder'=>'0']) ?>
    <?= $form->field($model, 'status',['options' => ['class' => 'activeform col-md-1']])->widget(CheckboxX::classname(),
        [
        'initInputType' => CheckboxX::INPUT_CHECKBOX,
        'options'=>['value' => $model->status],
        ])->label(false);
    ?>

    <div class="form-group btn_save">
        <?= Html::submitButton($model->isNewRecord ? 'Thêm mới': 'Chỉnh sửa', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php $this->registerJsFile('@web/tinymce/tinymce.min.js', ['depends' => [\yii\web\JqueryAsset::class]] );
 $this->registerJsFile('@web/js/main.js', ['depends' => [\yii\web\JqueryAsset::class]] );?>