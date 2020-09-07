<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\checkbox\CheckboxX;
/* @var $this yii\web\View */
/* @var $model quantri\modules\setting\models\Banner */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="banner-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'image',['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true,'id'=>'imageFile','placeholder'=>'Chọn ảnh cỡ 1920x464 px']) ?>
    <div class="col-md-5" style="height: 80px">
        <img src="<?= (isset($model->image))? $model->image:''?>" id="previewImage" alt="" style="height: 100%">
    </div>

    <?= $form->field($model, 'order',['options' => ['class' => 'col-md-2']])->textInput(['type'=>'number','max'=>998,'placeholder'=>'Bằng 999 nếu không nhập']) ?>

    <?= $form->field($model, 'status',['options' => ['class' => 'activeform col-md-1']])->widget(CheckboxX::classname(),
        [
        'initInputType' => CheckboxX::INPUT_CHECKBOX,
        'options'=>['value' => $model->status],
        ])->label(false);
    ?>
    <div class="clearfix"></div>
    <?= $form->field($model, 'url',['options' => ['class' => 'col-md-6']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alt',['options' => ['class' => 'col-md-6']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6,'class' => 'content']) ?>

    <div class="clearfix"></div>

    <div class="form-group btn_save">
        <?= Html::submitButton($model->isNewRecord ? ' Thêm mới ': ' Chỉnh sửa ', ['class' => 'btn btn-success btn_luu']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title text-center" id="myLargeModalLabel">Quản lý ảnh</h4> </div>
                <div class="modal-body">
                    <?php 
                    $user =  Yii::$app->user->identity->username;
                    $auth_key =  Yii::$app->user->identity->auth_key;
                    ?>
                    <iframe  width="100%" height="450" frameborder="0"
                    src="../../../filemanager2/dialog.php?type=1&field_id=imageFile&lang=en_EN&akey=<?= md5($user.$auth_key) ?>">
                </iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<?php
// $this->registerJsFile('@web/js/dichvu/addchitiet.js', ['depends' => [\yii\web\JqueryAsset::class]] );
$this->registerJsFile("@web/tinymce/tinymce.min.js", ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerJsFile("@web/js/main2.js", ['depends' => [yii\web\JqueryAsset::className()]]);
?>