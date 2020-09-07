<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\checkbox\CheckboxX;
use kartik\select2\Select2;
?>

<div class="setting-default-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'logo',['options' => ['class' => 'col-md-2']])->textInput(['maxlength' => true,'id'=>'imageFile','placeholder'=>'Up ảnh']) ?>
    <div class="col-md-2">
        <img src="<?= (isset($model->logo))? $model->logo:''?>" id="previewImage" alt=""  style="max-height:50px;margin-top: 24px;width:81%;">
    </div>
    <?= $form->field($model, 'google_analytics',['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true]) ?>
    <?php $form->field($model, 'layout_frontent',['options' => ['class' => 'col-md-3']])->widget(Select2::classname(), [
            'data' =>[0 => 'Full màn hình',1=>'3 cột'],
            'language' => 'en',
            'options' => ['placeholder' => 'Select a Menu...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>
    <?= $form->field($model, 'ad',['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true,'id'=>'imageFilebanner']) ?>
    <div class="col-md-2">
        <img src="<?= (isset($model->ad))? $model->ad:''?>" class="previewImage" alt=""  style="max-height:50px;margin-top: 24px;width:81%;">
    </div>
    <div class="clearfix"></div>
    <?= $form->field($model, 'title',['options' => ['class' => 'col-md-6']])->textInput(['maxlength' => 60,'placeholder'=>'Seo Title']) ?>
    <?= $form->field($model, 'keyword',['options' => ['class' => 'col-md-6']])->textInput(['maxlength' => true,'placeholder'=>'Nhập 1 đến 2 từ khóa, cách nhau bởi dấu phẩy']) ?>
    <div class="clearfix"></div>
    <?= $form->field($model, 'description',['options' => ['class' => 'col-md-12']])->textarea(['rows' => true,'maxlength' => 150,'placeholder'=>'Seo MetaDescription']) ?>
    
    <div class="clearfix"></div>
    <?= $form->field($model, 'tophead',['options' => ['class' => 'col-md-12']])->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'description_shopping',['options' => ['class' => 'col-md-6']])->textarea(['rows' => 3,'class'=>'content']) ?>
    <?= $form->field($model, 'bank_account',['options' => ['class' => 'col-md-6']])->textarea(['rows' => 3,'class'=>'content']) ?>
    <?= $form->field($model, 'footer_left',['options' => ['class' => 'col-md-6']])->textarea(['rows' => 5,'class'=>'content']) ?>
    <?= $form->field($model, 'footer_right',['options' => ['class' => 'col-md-6']])->textarea(['rows' => 5,'class'=>'content']) ?>
    <div class="form-group btn_save">
        <?= Html::submitButton($model->isNewRecord ? 'Thêm mới':'Cập nhật', ['class' => 'btn btn-success btn_luu']) ?>
        <?= Html::a('Hủy bỏ',Yii::$app->homeUrl, ['class' => 'btn btn-danger btn_luu']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<div class="modal modalmain fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="ModalBanner">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title text-center" id="myLargeModalLabel">Quản lý ảnh</h4> </div>
            <div class="modal-body">
                <?php 
                $user =  Yii::$app->user->identity->username;
                $auth_key =  Yii::$app->user->identity->auth_key;
                //dbg(md5($user.$auth_key));
                ?>
                <iframe  width="100%" height="450" frameborder="0"
                    src="../../../filemanager/dialog.php?type=2&field_id=imageFilebanner&lang=en_EN&akey=<?= md5($user.$auth_key) ?>">
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


<?php $this->registerJsFile('@web/tinymce/tinymce.min.js', ['depends' => [\yii\web\JqueryAsset::class]] );?>
<?php $this->registerJsFile('@web/js/main.js', ['depends' => [\yii\web\JqueryAsset::class]] );?>
<script type="text/javascript">
    // $(document).ready(function() {
    //     $(".imageFile").click(function (event) {
    //         $("#myModal").modal();
    //     })
    // });
</script>