<?php
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
?>

<div class="panel panel-default" style="positino: static; zoom: 1;">
    <div class="panel-heading" style="height: 40px;">
        <div class="panel-action active" style="width: 100%;">
            <a href="javascript:void(0)" data-perform="panel-collapse">
                <label style="width:95%;font-weight: 600;">Sản phẩm & Tin tức liên quan</label><i class="ti-minus"></i></a> <a href="javascript:void(0)" data-perform="panel-dismiss"><i class="ti-close"></i></a>
            </div>
        </div>

        <div class="panel-wrapper collapse">
            <div class="panel-body">
                <?= $form->field($model, 'related_articles')->widget(Select2::classname(), [
                    'data' => $data['news'],
                    'language' => 'en',
                    'options' => ['placeholder' => 'Chọn bài viết liên quan ...', 'multiple' => true],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);?>

                <?= $form->field($model, 'related_products')->widget(Select2::classname(), [
                    'data' => $data['products'],
                    'language' => 'en',
                    'options' => ['placeholder' => 'Select a product Type ...', 'multiple' => true],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);?>
            </div>
        </div>
    </div>

