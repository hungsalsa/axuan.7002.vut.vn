<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\checkbox\CheckboxX;
/* @var $this yii\web\View */
/* @var $model quantri\modules\news\models\Album */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="album-form">

    <?php $form = ActiveForm::begin([
            // 'id' => 'dynamic-form'
        ]); ?>
        
        <div class="col-md-12">
            <div class="panel panel-default block2">
                <!--<div class="panel-heading">Thông tin-->
                <!--    <div class="panel-action"><a href="javascript:void(0)" data-perform="panel-collapse"><i class="ti-minus"></i></a> <a href="javascript:void(0)" data-perform="panel-dismiss"><i class="ti-close"></i></a></div>-->
                <!--</div>-->
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <?= $form->field($model, 'cate_id',['options' => ['class' => 'col-md-2']])->widget(Select2::classname(), [
                                'data' => $data['allCate'],
                                'language' => 'vi',
                                'options' => ['placeholder' => 'Chọn'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]);
                        ?>
                       <?= $form->field($model, 'name',['options' => ['class' => 'col-md-4']])->textInput(['maxlength' => true,'id'=>'name_slug','placeholder' => 'Nhập tên']) ?>
                       <?= $form->field($model, 'slug',['options' => ['class' => 'col-md-4']])->textInput(['maxlength' => true,'id'=>'seo_slug','placeholder' => 'Url tự sinh, bạn có thể sửa']) ?>
                        <?= $form->field($model, 'sort',['options' => ['class' => 'col-md-2']])->textInput(['maxlength' => true,'placeholder' => '0']) ?>
                        <div class="clearfix"></div>
                        <?= $form->field($model, 'title',['options' => ['class' => 'col-md-5']])->textInput(['maxlength' => 60,'id'=>'seo_title','placeholder' => 'Seo Title']) ?>
                        <?= $form->field($model, 'keywords',['options' => ['class' => 'col-md-6']])->textInput(['maxlength' => true,'placeholder' => 'Nhập 1 đến 2 từ khóa, cách nhau bởi dấu phẩy']) ?>
                        <div class="clearfix"></div>
                        <?= $form->field($model, 'descriptions',['options' => ['class' => 'col-md-10']])->textarea(['rows' => 1,'maxlength' => 150,'placeholder' => 'Seo MetaDescription']) ?>
                        <?= $form->field($model, 'status',['options' => ['class' => 'activeform col-md-2']])->widget(CheckboxX::classname(),
                        [
                            'initInputType' => CheckboxX::INPUT_CHECKBOX,
                            'options'=>['value' => $model->status],
                            'pluginOptions'=>['threeState'=>false]
                        ])->label(false);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    <div class="form-group btn_save">
        <?= Html::submitButton($model->isNewRecord ? 'Thêm mới': 'Chỉnh sửa', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<?php
$this->registerJsFile("@web/tinymce/tinymce.min.js", ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerJsFile("@web/js/album_backend.js", ['depends' => [yii\web\JqueryAsset::className()]]);
?>
<style>
    .panel .panel-body {
    padding: 15px;
}
</style>