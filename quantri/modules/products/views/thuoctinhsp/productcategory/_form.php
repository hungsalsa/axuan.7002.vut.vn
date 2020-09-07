<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\checkbox\CheckboxX;
/* @var $this yii\web\View */
/* @var $model quantri\modules\quantri\models\Productcategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="productcategory-form">

    <?php $form = ActiveForm::begin(['enableAjaxValidation' => true]); ?>

    <?= $form->field($model, 'cateName',['options' => ['class' => 'col-md-4']])->textInput(['maxlength' => true,'id'=>'name_slug']) ?>

    <?= $form->field($model, 'product_parent_id',['options' => ['class' => 'col-md-4']])->widget(Select2::classname(), [
            'data' => $dataCat,
            'language' => 'vi',
            'options' => ['placeholder' => 'Select a category ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

    <?= $form->field($model, 'title',['options' => ['class' => 'col-md-4']])->textInput(['maxlength' => true]) ?>

    
    <?= $form->field($model, 'slug',['options' => ['class' => 'col-md-4']])->textInput(['maxlength' => true,'id'=>'seo_slug']) ?>

    <?= $form->field($model, 'image',['options' => ['class' => 'col-md-2']])->textInput(['maxlength' => true,'id'=>'imageFile','placeholder'=>'Click chọn ảnh']) ?>
    <div class="col-md-2" style="height: 80px">
        <img src="<?= (isset($model->image))? $model->image:''?>" id="previewImage" alt="" style="height: 100%">
    </div>
    <?= $form->field($model, 'order',['options' => ['class' => 'col-md-1']])->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'home_page',['options' => ['style'=>'display:none','class' => 'col-md-2 text-center activeform text-info']])->widget(CheckboxX::classname(),
        [
            'initInputType' => CheckboxX::INPUT_CHECKBOX,
            'options'=>['value' => $model->home_page],
            'pluginOptions'=>['threeState'=>false]
        ])->label(false);
        ?>

    <?= $form->field($model, 'keyword',['options' => ['class' => 'col-md-10']])->textInput(['rows' => 6]) ?>
    
    <?= $form->field($model, 'active',['options' => ['class' => 'col-md-1 text-center activeform text-info']])->widget(CheckboxX::classname(),
        [
            'initInputType' => CheckboxX::INPUT_CHECKBOX,
            'options'=>['value' => $model->active],
            'pluginOptions'=>['threeState'=>false]
        ])->label(false);
        ?>
    <div class="clearfix"></div>

    <?= $form->field($model, 'description')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'short_introduction')->textarea(['rows' => 3,'class'=>'content']) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6,'class'=>'content']) ?>


    <?php // $form->field($model, 'active')->textInput() ?>

    
    <br>
    <div class="form-group btn_save">
        <?= Html::submitButton($model->isNewRecord ? 'Thêm mới':'Cập nhật', ['class' => 'btn btn-success btn_luu']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<!-- sample modal content -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myLargeModalLabel">Quản lý ảnh</h4> </div>
            <div class="modal-body">
                <?php 
                $user =  Yii::$app->user->identity->username;
                $auth_key =  Yii::$app->user->identity->auth_key;
                ?>
                <iframe  width="100%" height="450" frameborder="0"
                    src="../../../filemanager/dialog.php?type=1&field_id=imageFile&lang=en_EN&akey=<?= md5($user.$auth_key) ?>">
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
$this->registerJsFile('@web/tinymce/tinymce.min.js',['depends' => [\yii\web\JqueryAsset::className() ] ]);
$this->registerJsFile('@web/js/main.js',['depends' => [\yii\web\JqueryAsset::className() ] ]); ?>