<?php
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\checkbox\CheckboxX;
?>

                <div class="panel panel-default" style="positino: static; zoom: 1;">
                    <div class="panel-heading">Kho hàng
                        <div class="panel-action">
                            <a href="javascript:void(0)" data-perform="panel-collapse">Chi tiết<i class="ti-minus"></i></a> <a href="javascript:void(0)" data-perform="panel-dismiss"><i class="ti-close"></i></a></div>
                    </div>

                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <?= $form->field($model, 'code',['options'=>['class'=>'col-md-3']])->textInput(['maxlength' => true]) ?>

                            <?= $form->field($model, 'inventory',['options'=>['class'=>'col-md-3']])->widget(Select2::classname(), [
                                'data' => $data['inventory'],
                                'options' => ['placeholder' => 'Select a color ...','id'=>'product_inventory_change'],
                                'pluginOptions' => [
                            // 'allowClear' => true,
                            // 'tags' => true,
                                ],
                            ]) ?>

                            <div id="product_inventory" style="<?= ($model->inventory==1)? 'display: block;':'display: none;' ?>">
                                <?= $form->field($model, 'amount',['options'=>['class'=>'col-md-3']])->textInput(['maxlength' => true]) ?>
                                <?= $form->field($model, 'order_out_stock',['options' => ['class' => 'col-md-5']])->widget(CheckboxX::classname(),
                                    [
                                        'initInputType' => CheckboxX::INPUT_CHECKBOX,
                                        'options'=>['value' => $model->order_out_stock],
                                        'pluginOptions'=>['threeState'=>false]
                                    ])->label(false);
                                    ?>
                            </div>

                        </div>
                    </div>
                </div>
                
