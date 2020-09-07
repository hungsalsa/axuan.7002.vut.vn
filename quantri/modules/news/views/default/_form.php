<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\checkbox\CheckboxX;

/* @var $this yii\web\View */
/* @var $model quantri\modules\quantri\models\News */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-form">
    <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($model, 'category_id',['options' => ['class' => 'col-md-3']])->widget(Select2::classname(), [
                    'data' => $data['categories'],
                    'language' => 'vi',
                    'options' => ['placeholder' => 'Chọn danh mục cần đăng bài viết'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
            ?>
            <?= $form->field($model, 'name',['options'=>['class'=>'col-md-6']])->textInput(['maxlength' => true,'id'=>'name_slug','placeholder' => 'Nhập tiêu đề bài viết']) ?>
            <?= $form->field($model, 'images',['options' => ['class' => 'col-md-2']])->textInput(['maxlength' => true,'id'=>'imageFile','placeholder'=>'Chọn ảnh']) ?>
            <div class="col-md-1" style="height: 80px">
                <img src="<?= (isset($model->images))? Yii::$app->request->hostInfo.'/'.$model->images:''?>" id="previewImage" alt="" style="height: 81%">
            </div>
            <div class="clearfix"></div>
            <?= $form->field($model, 'newSlug',['options' => ['class' => 'col-md-6']])->textInput(['maxlength' => true,'id'=>'seo_slug','placeholder' => 'Url tự sinh, bạn có thể thay đổi']) ?>
            <?php $form->field($model, 'hot',['options' => ['class' => 'activeform col-md-1']])->widget(CheckboxX::classname(),
                [
                    'initInputType' => CheckboxX::INPUT_CHECKBOX,
                    'options'=>['value' => $model->hot],
                    'pluginOptions'=>['threeState'=>false]
                ])->label(false);
            ?>
            
            <?= $form->field($model, 'sort',['options' => ['class' => 'col-md-1']])->textInput(['type' => 'number','placeholder' => '0']) ?>
            <?= $form->field($model, 'view',['options' => ['class' => 'col-md-1']])->textInput(['type' => 'number','placeholder' => '0']) ?>
            <?= $form->field($model, 'status',['options' => ['class' => 'activeform col-md-1']])->widget(CheckboxX::classname(),
                [
                    'initInputType' => CheckboxX::INPUT_CHECKBOX,
                    'options'=>['value' => $model->status],
                    'pluginOptions'=>['threeState'=>false]
                ])->label(false);
            ?>
            <?= $form->field($model, 'formshow',['options' => ['class' => 'activeform col-md-2']])->widget(CheckboxX::classname(),
                [
                    'initInputType' => CheckboxX::INPUT_CHECKBOX,
                    'options'=>['value' => $model->formshow],
                    'pluginOptions'=>['threeState'=>false]
                ])->label(false);
            ?>
            <?= $form->field($model, 'interest',['options' => ['class' => 'activeform col-md-2']])->widget(CheckboxX::classname(),
                [
                    'initInputType' => CheckboxX::INPUT_CHECKBOX,
                    'options'=>['value' => $model->interest],
                    'pluginOptions'=>['threeState'=>false]
                ])->label(false);
            ?>
            <div class="clearfix"></div>
            <?= $form->field($model, 'tags',['options' => ['class' => 'col-md-6']])->widget(Select2::classname(), [
                    'data' => $data['tags'],
                    'language' => 'vi',
                    'options' => ['placeholder' => 'Nhập tag và nhấn Enter', 'multiple' => true],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'tags' => true
                    ],
                ]);
                ?>
            <?= $form->field($model, 'htmltitle',['options' => ['class' => 'col-md-6']])->textInput(['maxlength' => 60,'id'=>'seo_title','placeholder' => 'Seo Title']) ?>
            <div class="clearfix"></div>
            <?= $form->field($model, 'htmldescriptions',['options' => ['class' => 'col-md-8']])->textarea(['rows' => 1,'maxlength' => 150,'placeholder' => 'Seo MetaDescription']) ?>
            <?= $form->field($model, 'htmlkeyword',['options' => ['class' => 'col-md-4']])->textInput(['maxlength' => true,'placeholder' => 'Nhập 1 đến 2 từ khóa, cách nhau bởi dấu phẩy']) ?>
                <div class="clearfix"></div>
                <!--Mô tả ngắn-->
                <?= $form->field($model, 'short_description',['options' => ['class' => 'col-md-12']])->textarea(['rows' => 6]) ?>
                <?= $form->field($model, 'content',['options' => ['class' => 'col-md-12']])->textarea(['rows' => 6,'class' => 'content']) ?>
                <?= $form->field($model, 'related_products',['options' => ['class' => 'col-md-12']])->widget(Select2::classname(), [
                    'data' => $data['products'],
                    'language' => 'vi',
                    'options' => ['placeholder' => 'Chọn', 'multiple' => true],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
                ?>
                <?= $form->field($model, 'related_news',['options' => ['class' => 'col-md-12']])->widget(Select2::classname(), [
                    'data' => $data['news'],
                    'language' => 'vi',
                    'options' => ['placeholder' => 'Chọn', 'multiple' => true],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
                ?>
                <?= $form->field($model, 'related_albums',['options' => ['class' => 'col-md-12']])->widget(Select2::classname(), [
                    'data' => $data['albums'],
                    'language' => 'vi',
                    'options' => ['placeholder' => 'Chọn', 'multiple' => true],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
                ?>
                <?= $form->field($model, 'related_downloads',['options' => ['class' => 'col-md-12']])->widget(Select2::classname(), [
                    'data' => $data['downloads'],
                    'language' => 'vi',
                    'options' => ['placeholder' => 'Chọn', 'multiple' => true],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
                ?>
     <div class="form-group btn_save">
        <?= Html::submitButton($model->isNewRecord ? 'Thêm mới': 'Cập nhật', ['class' => 'btn btn-success']) ?>
        <?= Html::a('  Hủy  ', ['index'], ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$this->registerJsFile("@web/tinymce/tinymce.min.js", ['depends' => [yii\web\JqueryAsset::className()]]);
// $this->registerJsFile("@web/js/jquery.fileupload.js", ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerJsFile("@web/js/main.js", ['depends' => [yii\web\JqueryAsset::className()]]);
?>