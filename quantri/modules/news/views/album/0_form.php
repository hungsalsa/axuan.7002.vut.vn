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
        
        <div class="col-md-9">
            <div class="panel panel-default block2">
                <div class="panel-heading">Thông tin
                    <div class="panel-action"><a href="javascript:void(0)" data-perform="panel-collapse"><i class="ti-minus"></i></a> <a href="javascript:void(0)" data-perform="panel-dismiss"><i class="ti-close"></i></a></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                       <?= $form->field($model, 'name',['options' => ['class' => 'col-md-4']])->textInput(['maxlength' => true,'id'=>'name_slug']) ?>

                       <?= $form->field($model, 'slug',['options' => ['class' => 'col-md-4']])->textInput(['maxlength' => true,'id'=>'seo_slug']) ?>


                       <?= $form->field($model, 'status',['options' => ['class' => 'activeform col-md-1']])->widget(CheckboxX::classname(),
                        [
                            'initInputType' => CheckboxX::INPUT_CHECKBOX,
                            'options'=>['value' => $model->status],
                            'pluginOptions'=>['threeState'=>false]
                        ])->label(false);
                        ?>
                        <div class="clearfix"></div>
                        <?= $form->field($model, 'title',['options' => ['class' => 'col-md-6']])->textInput(['maxlength' => true,'id'=>'seo_title']) ?>

                        <?= $form->field($model, 'keywords',['options' => ['class' => 'col-md-6']])->textInput(['maxlength' => true]) ?>
                        <div class="clearfix"></div>


                        <?= $form->field($model, 'descriptions')->textarea(['rows' => 3]) ?>

                        <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>
                    </div>
                </div>
            </div>

        </div>
    <div class="col-md-3">

        <div class="panel panel-default thongsokythuat">
            <div class="panel-heading"><i class="glyphicon glyphicon-envelope"></i> Danh sách ảnh
                <div class="panel-action" style="margin-top: -8px;">
                    <button type="button" data-action="<?= $this->context->action->id ?>" class="add-image fcbtn btn btn-danger btn-outline btn-1d">
                        <i class="glyphicon glyphicon-plus"><label class="">AddImage</label></i> 
                    </button>
                    <a href="javascript:void(0)" data-perform="panel-collapse"><i class="ti-minus"></i></a> <a href="javascript:void(0)" data-perform="panel-dismiss"><i class="ti-close"></i></a>
                </div>
            </div>
            <div class="panel-wrapper collapse in">

                <div class="panel-body">
                    <div class="container-items"><!-- widgetBody -->
                        <div class="item panel panel-default"><!-- widgetItem -->

                            <div class="panel-body">
                                <ul id="ImageListAlbum" style="padding: 0;">

                                </ul>
                            </div><!-- .row -->
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .panel -->
    </div>


    <div class="form-group btn_save">
        <?= Html::submitButton($model->isNewRecord ? 'Thêm mới': 'Chỉnh sửa', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<div class="modal modalAdimage fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalAdimage">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title text-center" id="myLargeModalLabelImage">Thêm mới ảnh</h4> </div>
            <div class="modal-body">
                <?= $form->field($modelsImages, 'image',['options' => ['class' => 'col-md-6']])->textInput(['maxlength' => true,'id'=>'imageFile','placeholder'=>'Chọn ảnh cỡ 370x165 px']) ?>

                <?= $form->field($modelsImages, 'title',['options' => ['class' => 'col-md-6']])->textInput(['maxlength' => true,'id'=>'Imagetitle']) ?>
                <?= $form->field($modelsImages, 'descriptions',['options' => ['class' => 'col-md-12']])->textInput(['maxlength' => true,'id'=>'Imagedescriptions']) ?>
            </div>
            <div class="modal-footer">
                <button type="button" data-action="<?= $this->context->action->id ?>" id="AddNewImage" class="btn btn-info waves-effect text-left" data-dismiss="modal">AddImage</button>
                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
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