<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\checkbox\CheckboxX;
use kartik\select2\Select2;
if ($model->parent_id != 0){$disnone = 'display:none'; }else {
    $disnone='';
}
?>

<div class="setting-modules-form">
    <?php $form = ActiveForm::begin(['enableAjaxValidation' => true]); ?>
    <?= $form->field($model, 'type_module',['options' => ['class' => 'col-md-2']])->widget(Select2::classname(), [
            'data' => $data['types'],
            'language' => 'en',
            'options' => ['placeholder' => 'Chọn','id'=>'module_type_select'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>
    <?= $form->field($model, 'name',['options' => ['class' => 'col-md-4']])->textInput(['maxlength' => true,'placeholder'=>'Nhập tên module']) ?>
    <?= $form->field($model, 'parent_id',['options' => ['class' => 'col-md-3']])->widget(Select2::classname(), [
            'data' => $data['parent_id'],
            'language' => 'en',
            'options' => ['placeholder' => 'Bỏ qua nếu là MODULE CẤP 1','id'=>'SettingModules_parent_id'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>
    <div class="clearfix"></div>
    <?= $form->field($model, 'positions',['options' => ['class' => 'col-md-2','id'=>'Parent_module_positions','style'=>$disnone]])->widget(Select2::classname(), [
            'data' => $data['position'],
            'language' => 'en',
            'options' => ['placeholder' => 'Chọn','id'=>'module_positions'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>
    <?php if ($this->context->action->id =='update' && $model->type_module =='custom'||$this->context->action->id =='update' && $model->type_module =='form'){
        $display = 'display:none';
    } else{
        $display = 'display:block';
    }
    ?>
    <?= $form->field($model, 'hienthi',['options' => ['class' => 'col-md-3','id'=>'Parent_SettingModules_hienthi','style'=>$display]])->widget(Select2::classname(), [
        'data' => $data['hienthi'],
        'language' => 'en',
        'options' => ['placeholder' => 'Chọn khi thiết lập Ở GIỮA trang chủ','id'=>'SettingModules_hienthi'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>
    <?= $form->field($model, 'cate_id',['options' => ['class' => 'col-md-3','id'=>'module_type_cateid_out','style'=>$display]])->widget(Select2::classname(), [
            'data' => $data['LinkCat'],
            'language' => 'en',
            'options' => ['placeholder' => 'Chọn danh mục cần liên kết','id'=>'module_type_cateid'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>
    <!-- $('#Parent_module_positions').hide();
    $('#_SettingModules_status').hide();
    $('#_SettingModules_page_show').hide();
    $('#_SettingModules_count_pro').hide();
    $('#Parent_SettingModules_hienthi').hide(); -->
    <?= $form->field($model, 'order',['options' => ['class' => 'col-md-1']])->textInput(['placeholder' => '0']) ?>
    <div class="clearfix"></div>
    <!--Trang hiển thị-->
    <?= $form->field($model, 'page_show',['options' => ['class' => 'col-md-9','id' => '_SettingModules_page_show','style'=>$disnone]])->widget(Select2::classname(), [
            'data' => $data['page_show'],
            'language' => 'en',
            'options' => ['placeholder' => 'Chọn','multiple'=>true,'id' => 'Modules_page_show'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>
    <!--Trạng thái-->
    <?= $form->field($model, 'status',['options' => ['class' => 'activeform col-md-2','id' => '_SettingModules_status']])->widget(CheckboxX::classname(),
        [
            'initInputType' => CheckboxX::INPUT_CHECKBOX,
            'options'=>['value' => $model->status],
            'pluginOptions'=>['threeState'=>false]
        ])->label(false);
    ?>
    <?php if ($this->context->action->id =='update' && $model->type_module =='custom'){
        $display = 'display:block';
    } else{
        $display = 'display:none';
    }
    ?>
    <?= $form->field($model, 'content',['options' => ['class' => 'col-md-12','id' => 'module_content']])->textarea(['rows' => 6,'class'=>'content']) ?>
    <div class="form-group btn_save">
        <?= Html::submitButton($model->isNewRecord ? 'Thêm mới':'Chỉnh sửa', ['class' => 'btn btn-success btn_luu']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<?php 
$this->registerJsFile("@web/tinymce/tinymce.min.js", ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/js/myjs/modules.js', ['depends' => [\yii\web\JqueryAsset::class]] );
$this->registerJsFile("@web/js/main.js", ['depends' => [yii\web\JqueryAsset::className()]]);