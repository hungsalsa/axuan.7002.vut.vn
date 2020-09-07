<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\checkbox\CheckboxX;
use kartik\number\NumberControl;
use yii\helpers\Url;
use kartik\datetime\DateTimePicker;
use dosamigos\fileupload\FileUploadUI;
use kartik\date\DatePicker;
use wbraganca\dynamicform\DynamicFormWidget;
use wbraganca\tagsinput\TagsinputWidget;
?>
<div class="panel panel-default" style="positino: static; zoom: 1;">
    <div class="panel-heading">Trạng thái1</div>
    <div class="panel-wrapper collapse in">
        <div class="panel-body">
            <?= $form->field($model, 'status',['options'=>['id' => 'product_status','class'=>'text-center text-info']])->radioList([1 =>'Hiển thị',0=>'Ẩn'])->label(false); ?>
                <a href="javasript:void(0)" id="show_product_time_status">Đặt lịch hiển thị</a>
                <div id="product_time_status">
                    <?= $form->field($model, 'time_status',['options'=>['class'=>'col-md-10']])->widget(DateTimePicker::classname(), [
                        'options' => ['placeholder' => 'Set the time ...'],
                        'pluginOptions' => [
                            'autoclose' => true
                        ]
                    ])->label(false); ?>
                        <label class="close col-md-1 pull-left icon-list-demo"><i class="ti-close"></i></label>
                </div>
        </div>
    </div>
</div>

<?php if ($this->context->action->id=='create'): ?>

    <div class="panel panel-default" style="position: static; zoom: 1;">
        <div class="panel-heading">Giá sản phẩm</div>
        <div class="panel-wrapper collapse in">
            <div class="panel-body">
                <?= $form->field($model, 'price',['options'=>['class'=>'col-md-11']])->widget(NumberControl::classname(), [
                        'maskedInputOptions' => [
                            'prefix' => '',
                            'suffix' => ' đ',
                            'allowMinus' => false,
                            'groupSeparator' => '.',
                            'radixPoint' => ','
                        ],
                        'displayOptions' => ['class' => 'form-control kv-monospace'],
                    ]);
                    ?>
                    <?= $form->field($model, 'price_sales',['options'=>['class'=>'col-md-11']])->widget(NumberControl::classname(), [
                        'maskedInputOptions' => [
                            'prefix' => '',
                            'suffix' => ' đ',
                            'allowMinus' => false,
                            'groupSeparator' => '.',
                            'radixPoint' => ','
                        ],
                        'displayOptions' => ['class' => 'form-control kv-monospace'],
                        'saveInputContainer' => ['class' => 'kv-saved-cont']
                    ]);
                    ?>

                        <?=  $form->field($model, 'start_sale',['options'=>['class'=>'col-md-11']])->widget(DatePicker::classname(), [
                        'options' => ['placeholder' => 'Enter birth date ...'],
                        'pluginOptions' => [
                            'autoclose'=>true
                        ]
                    ]); ?>
                            <?=  $form->field($model, 'end_sale',['options'=>['class'=>'col-md-11']])->widget(DatePicker::classname(), [
                        'options' => ['placeholder' => 'Enter birth date ...'],
                        'pluginOptions' => [
                            'autoclose'=>true
                        ]
                    ]); ?>
                                <?= $form->field($model, 'vat',['options' => ['class' => 'col-md-11']])->widget(CheckboxX::classname(),
                        [
                            'initInputType' => CheckboxX::INPUT_CHECKBOX,
                            'options'=>['value' => $model->vat],
                            'pluginOptions'=>['threeState'=>false]
                        ])->label(false);
                        ?>

            </div>
        </div>
    </div>

    <?php endif ?>

        <div class="panel panel-default status" style="position: static; zoom: 1;">
            <div class="panel-heading">Phân loại</div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <?= $form->field($model, 'highlights',['options' => ['class' => 'col-md-12']])->widget(CheckboxX::classname(),
                        [
                            'initInputType' => CheckboxX::INPUT_CHECKBOX,
                            'options'=>['value' => $model->highlights],
                            'pluginOptions'=>['threeState'=>false]
                        ])->label(false);
                        ?>
                        <?= $form->field($model, 'order',['options'=>['class'=>'col-md-11']])->textInput() ?>
                            <?= $form->field($model, 'product_type_id',['options'=>['class'=>'col-md-11']])->widget(Select2::classname(), [
                            'data' => $data['productType'],
                            'options' => ['placeholder' => 'Select a color ...'],
                            'pluginOptions' => [
                                'allowClear' => true,
                                'tags' => true,
                            ],
                        ]) ?>
                                <?= $form->field($model, 'supplier_id',['options'=>['class'=>'col-md-11']])->widget(Select2::classname(), [
                            'data' => $data['suppliers'],
                            'options' => ['placeholder' => 'Select a color ...'],
                            'pluginOptions' => [
                                'allowClear' => true,
                                'tags' => true,
                            ],
                        ]) ?>
                                    <span class="boder-buttom clearfix col-md-12"></span>
                                    <?= $form->field($model, 'product_category_id',['options'=>['class'=>'col-md-11']])->widget(Select2::classname(), [
                            'data' => $data['suppliers'],
                            'options' => ['placeholder' => 'Select a color ...'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]) ?>

                        <?= $form->field($model, 'tags',['options'=>['class'=>'col-md-11']])->widget(TagsinputWidget::classname(), [
                            'options' => ['placeholder' => 'Add tags product','class'=>'form-control'],
                            'clientOptions' => [
                                'trimValue' => true,
                                'allowDuplicates' => false,

                                'delimiter' => ';'
                            ]
                        ]) ?>

                </div>
            </div>
        </div>