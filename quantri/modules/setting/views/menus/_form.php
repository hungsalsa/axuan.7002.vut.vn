<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\checkbox\CheckboxX;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model quantri\modules\setting\models\Menus */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="menus-form">
    <?php $form = ActiveForm::begin(['enableClientValidation' => true, 'enableAjaxValidation' => false]); ?>
    <?= $form->field($model, 'type',['options' => ['class' => 'col-md-2']])->widget(Select2::classname(), [
            'data' => $menuType,
            'language' => 'en',
            'options' => [
                'placeholder' => 'Chọn',
                'id' => 'MenuSettingType',
                'data-url' => Url::toRoute('/setting/menus/lists'),
            ],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ]);
    ?>
    <?= $form->field($model, 'link_cate',['options' => ['class' => 'col-md-3','id'=>'parentMenuSettinglink_cate']])->widget(Select2::classname(), [
            'data' => $dataLinkCat,
            'language' => 'en',
            'options' => ['placeholder' => 'Chọn danh mục cần liên kết','id'=>'MenuSettinglink_cate'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>
    <?= $form->field($model, 'name',['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true,'id'=>'name_slug','placeholder'=>'Nhập tên menu']) ?>
    <?= $form->field($model, 'parent_id',['options' => ['class' => 'col-md-3']])->widget(Select2::classname(), [
            'data' => $dataMenus,
            'language' => 'en',
            'options' => ['placeholder' => 'Bỏ qua nếu là MENU CẤP 1','Module_Parent_id'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>
    <div class="clearfix"></div>
    <?= $form->field($model, 'order',['options' => ['class' => 'col-md-1']])->textInput(['type'=>'number','placeholder'=>'1']) ?>
    <?= $form->field($model, 'image',['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true,'id'=>'imageFile','placeholder'=>'Chọn ảnh']) ?>
    <div class="col-md-2" style="height: 80px">
        <img src="<?= (isset($model->image))? Yii::$app->request->hostInfo.'/'.$model->image:''?>" id="previewImage" alt="" style="height: 81%">
    </div>
    <?= $form->field($model, 'status',['options' => ['class' => 'activeform col-md-1']])->widget(CheckboxX::classname(),
        [
        'initInputType' => CheckboxX::INPUT_CHECKBOX,
        'options'=>['value' => $model->status],
        ])->label(false);
    ?>
    <div class="clearfix"></div>
    <?php if($this->context->action->id=='update' && $model->type=='4'){$display = 'block';}else {
        $display = 'none';
    } ?>
    <div class="help-block-success" style="font-size: 12px;color: #0066ffc7;<?= (isset($model->type)&& $model->type==4)?'':'display: none;'; ?>">Thêm thuộc tính '<\a\>':  data-hover="dropdown" class="dropdown-toggle"</div>
    <?= $form->field($model, 'introduction',['options' => ['id'=>'MenuSettingContent','style' => 'display:'.$display]])->textarea(['rows' => 6,'class'=>'content']) ?>
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
<?php $this->registerJsFile('@web/tinymce/tinymce.min.js', ['depends' => [\yii\web\JqueryAsset::class]] );
$this->registerJsFile('@web/js/main.js', ['depends' => [\yii\web\JqueryAsset::class]] );
$this->registerJsFile('@web/js/myjs/menu_setting.js', ['depends' => [\yii\web\JqueryAsset::class]] );?>