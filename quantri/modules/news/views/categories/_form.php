<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\checkbox\CheckboxX;
/* @var $this yii\web\View */
/* @var $model quantri\modules\quantri\models\Categories */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categories-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'cateName',['options'=>['class'=>'col-md-3']])->textInput(['maxlength' => true,'id'=>'name_slug','placeholder'=>'Nhập tên danh mục']) ?>
    <?=
        $form->field($model, 'parent_id',['options'=>['class'=>'col-md-3']])->widget(Select2::classname(), [
            'data' => $data['newsCategories'],
            'language' => 'vi',
            'options' => ['placeholder' => 'Bỏ qua nếu là DANH MỤC CẤP 1'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
     ?>
     <?= $form->field($model, 'sort',['options' => ['class' => 'col-md-2']])->textInput(['placeholder'=>'0']) ?>

     <?= $form->field($model, 'status',['options' => ['class' => 'activeform col-md-1']])->widget(CheckboxX::classname(),
        [
            'initInputType' => CheckboxX::INPUT_CHECKBOX,
            'options'=>['value' => $model->status],
            'pluginOptions'=>['threeState'=>false]
        ])->label(false);
        ?>
    <div class="clearfix"></div>
    <?= $form->field($model, 'title',['options'=>['class'=>'col-md-5']])->textInput(['maxlength' => 60,'id'=>'seo_title','placeholder'=>'Seo Title']) ?>
    <?= $form->field($model, 'slug',['options'=>['class'=>'col-md-3']])->textInput(['maxlength' => true,'id'=>'seo_slug','placeholder' => 'Url tự sinh, bạn có thể thay đổi']) ?>
    <?= $form->field($model, 'images',['options' => ['class' => 'col-md-2']])->textInput(['maxlength' => true,'id'=>'imageFile','placeholder'=>'Chọn ảnh']) ?>
    <div class="col-md-2" style="height: 80px">
        <img src="<?= (isset($model->image))? Yii::$app->request->hostInfo.'/'.$model->image:''?>" id="previewImage" alt="" style="height: 81%">
    </div>
    <div class="clearfix"></div>
    <?= $form->field($model, 'descriptions',['options'=>['class'=>'col-md-8']])->textarea(['rows' => 1,'maxlength' => 150,'placeholder'=>'Seo MetaDescription']) ?>
    <?= $form->field($model, 'keyword',['options' => ['class' => 'col-md-4']])->textInput(['maxlength' => true,'placeholder'=>'Nhập 1 đến 2 từ khóa, cách nhau bởi dấu phẩy']) ?>
    <div class="form-group btn_save" style="float:left;margin:21px">
      <?= Html::submitButton($model->isNewRecord ? 'Thêm mới': 'Chỉnh sửa', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<?php
$this->registerJsFile("@web/tinymce/tinymce.min.js", ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerJsFile("@web/js/album_backend.js", ['depends' => [yii\web\JqueryAsset::className()]]);
?>