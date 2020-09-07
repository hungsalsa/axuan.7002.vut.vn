<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\checkbox\CheckboxX;
use wbraganca\dynamicform\DynamicFormWidget;
/* @var $this yii\web\View */
/* @var $model quantri\modules\news\models\Album */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="album-form">

    <?php $form = ActiveForm::begin([
            'id' => 'dynamic-form'
        ]); ?>
        
<div class="col-md-9">
    <div class="panel panel-default block2">
        <div class="panel-heading">Panel with action
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
    

    <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 4, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelsImages[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'image',
                    'title',
                    'descriptions',
                ],
            ]); ?>

    <div class="panel panel-default thongsokythuat">
        <div class="panel-heading"><i class="glyphicon glyphicon-envelope"></i> Danh sách ảnh
            <div class="panel-action">
                <button type="button" class="add-item fcbtn btn btn-danger btn-outline btn-1d">
                    <i class="glyphicon glyphicon-plus"><label class="">Add</label></i> 
                </button>
                <a href="javascript:void(0)" data-perform="panel-collapse"><i class="ti-minus"></i></a> <a href="javascript:void(0)" data-perform="panel-dismiss"><i class="ti-close"></i></a>
            </div>
        </div>
        <div class="panel-wrapper collapse in">

            <div class="panel-body" style="background: #89878780;padding: 0;">
                <div class="container-items"><!-- widgetBody -->
                    <?php foreach ($modelsImages as $i => $modelImage): ?>
                        <div class="item panel panel-default"><!-- widgetItem -->
                            
                                <div class="panel-body">
                                    <?php
                            // necessary for update action.
                                    if (! $modelImage->isNewRecord) {
                                        echo Html::activeHiddenInput($modelImage, "[{$i}]id");
                                    }
                                    ?>
                                    <div class="row">
                                        <?= $form->field($modelImage, "[{$i}]image",['options'=>['class'=>'col-md-10']])->textInput(['maxlength' => true,'class'=>'imageAlbum form-control','placeholder'=>'Click chọn ảnh',"onchange"=>"fileSelect([{$i}])"]) ?>

                                        <?= $form->field($modelImage, "[{$i}]title",['options'=>['class'=>'col-md-10']])->textInput(['maxlength' => true]) ?>
                                        <?= $form->field($modelImage, "[{$i}]descriptions",['options'=>['class'=>'col-md-10']])->textInput(['maxlength' => true]) ?>


                                        
                                        <div class="xá">
                                            <button type="button" class="remove-item btn btn-danger btn-xs" style="margin-top: 6px"><i class="glyphicon glyphicon-minus"></i></button>
                                        </div>
                                    </div>
                                </div><!-- .row -->
                            </div>
                        </div>
                    <?php endforeach; ?>
            </div>
        </div>
    </div><!-- .panel -->
    <?php DynamicFormWidget::end(); ?>
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