<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\checkbox\CheckboxX;
?>

<div class="album-images-form">
    <?php $form = ActiveForm::begin(); ?>
    <?php  if ($_GET['album_id']!=''): ?>
    	<?= $form->field($model, 'album_id',['options' => ['class' => 'col-md-3','style'=>'display:none']])->hiddenInput()->label(false) ?>
    	<?php else: ?>
    		<?= $form->field($model, 'album_id',['options' => ['class' => 'col-md-3']])->textInput() ?>
    	<?php endif ?>
    <?= $form->field($model, 'image',['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true,'id'=>'imageFile','placeholder'=>'Chọn ảnh ']) ?>
    <div class="col-md-2" style="height: 80px">
        <img src="<?= (isset($model->image))? Yii::$app->request->hostInfo.'/'.$model->image:''?>" id="previewImage" alt="" style="height: 81%">
    </div>
    <div class="clearfix"></div>
    <?= $form->field($model, 'alt',['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true,'placeholder'=>'Seo Alt - Google đọc ảnh qua thẻ này']) ?>
    <?= $form->field($model, 'title',['options' => ['class' => 'col-md-2']])->textInput(['maxlength' => true,'placeholder'=>'Title ảnh']) ?>
    <?= $form->field($model, 'sort',['options' => ['class' => 'col-md-1']])->textInput(['placeholder'=>'0']) ?>
    <div class="clearfix"></div>
    <?= $form->field($model, 'descriptions',['options' => ['class' => 'col-md-6']])->textarea(['rows' => 3]) ?>
    <?= $form->field($model, 'status',['options' => ['class' => 'activeform col-md-1']])->widget(CheckboxX::classname(),
        [
            'initInputType' => CheckboxX::INPUT_CHECKBOX,
            'options'=>['value' => $model->status],
            'pluginOptions'=>['threeState'=>false]
        ])->label(false);
    ?>
    <div class="form-group btn_save">
      <?= Html::submitButton($model->isNewRecord ? 'Thêm mới': 'Chỉnh sửa', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
<?php
$this->registerJsFile("@web/tinymce/tinymce.min.js", ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerJsFile("@web/js/main.js", ['depends' => [yii\web\JqueryAsset::className()]]);
?>