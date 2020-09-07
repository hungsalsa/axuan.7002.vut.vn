<?php
use yii\helpers\Html;
use kartik\checkbox\CheckboxX;
use kartik\number\NumberControl;
use kartik\date\DatePicker;
?>
<div class="table-responsive">
    <table class="table" cellspacing="14">
        <thead>
            <th width="5%">STT</th>
            <th width="15%">Ngày</th>
            <th>Tên phiên bản </th>
            <th width="15%">Giá KM/Giá gốc 1</th>
            <th width="15%">Giá 2</th>
            <th width="15%">Giá 3</th>
            <th width="10%" class="text-center">Trạng thái</th>
            <th width="10%" class="text-center">Action</th>
        </thead>
        <tbody id="body_versions_list">
            <?php if (isset($productVersions) && $productVersions): //dbg($productVersions)?>
                <?php foreach ($productVersions as $kpb => $va_pb): ?>
                    <tr class="row_versions" id="row_versions_<?= $va_pb->id ?>">
                        <td><?= $kpb+1 ?></td>
                        <td id="versionDate_<?=$va_pb->id ?>">
                            <?=  Yii::$app->formatter->asDate($va_pb->date, 'd-MM-Y');  ?>
                        </td>
                        <td id="versionName_<?=$va_pb->id ?>">
                            <?= $va_pb->name ?>
                        </td>
                        <td>
                            <?php if ($va_pb->price_sale_1>0): ?>
                                <span id="versionPrice_1<?=$va_pb->id ?>"><?= number_format((int) $va_pb->price_sale_1, 0, ',', '.') ?></span> / 
                                <del id="versionPrice_sale_1<?=$va_pb->id ?>"><?= number_format((int) $va_pb->price_1, 0, ',', '.') ?></del>
                            <?php else: ?>
                                <span id="versionPrice_1<?=$va_pb->id ?>">Không / </span>
                                <span id="versionPrice_sale_1<?=$va_pb->id ?>"><?= number_format((int) $va_pb->price_1, 0, ',', '.') ?></span>
                            <?php endif ?>
                            
                        </td>
                        
                        <td id="versionPrice_2<?=$va_pb->id ?>">
                            <?= number_format((int) $va_pb->price_2, 0, ',', '.') ?>
                        </td>
                        <td id="versionPrice_3<?=$va_pb->id ?>">
                            <?= number_format((int) $va_pb->price_3, 0, ',', '.') ?>
                        </td>

                        <td>
                            <a id="versionStatus_<?=$va_pb->id ?>" onclick="statusVersionPro(<?=$va_pb->id ?>)" href="javascript:void(0)" class="btn btn-info btn-sm"> <?= ($va_pb->status==1)?'Kích hoạt':' Ẩn ' ?> </a>
                            
                        </td>

                        <td>
                            <a onclick="editVersionPro(<?= $va_pb->id ?>)" href="javascript:void(0)" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>
                            <a onclick="deleteVersionPro(<?=$va_pb->id ?>)" href="javascript:void(0)" data-toggle="tooltip" data-original-title="Close"> <i class="fa fa-close text-danger"></i> </a>
                        </td>
                    </tr>
                <?php endforeach ?>
            <?php endif ?>
        </tbody>
    </table>
</div>

<div class="modal fade bd-example-modal-lg" tabindex="-1" data-keyboard="true" data-backdrop="static" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalProductVersion">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title text-center" id="myLargeModalLabel">Thêm các phiên bản sản phẩm</h4> </div>
            <div class="modal-body" style="overflow: hidden;">
                    <?= Html::hiddenInput('product_id', $product_id, ['class' => 'form-control','id'=>'versionProduct_id']) ?>
                    <?= Html::hiddenInput('idVersion', '', ['class' => 'form-control','id'=>'idVersion']) ?>
                    <?= Html::hiddenInput('action', '', ['class' => 'form-control','id'=>'versionAction']) ?>

                <div class="col-md-3 form-group">
                    <label class="control-label">Check Date</label>
                    <?= DatePicker::widget([
                    'name' => 'productVersionDate',
                    // 'value' => '01/29/2014',
                    // 'removeButton' => false,
                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                    'pickerIcon' => '<i class="fa fa-calendar text-primary"></i>',
                    'removeIcon' => '<i class="fa fa-trash text-danger"></i>',
                    'options' => ['placeholder' => 'Enter date','id'=>'productVersionDate'],
                    'pluginOptions' => [
                        'todayHighlight' => true,
                        'todayBtn' => true,
                        'autoclose'=>true,
                        'format' => 'dd-mm-yyyy'
                    ]
                    ]);?>
                </div>
                <div class="col-md-3 form-group">
                    <?= Html::label('Tên phiên bản', 'productVersionName') ?>
                    <?= Html::textInput('productVersionName', null, ['class' => 'form-control','id'=>'productVersionName']) ?>
                </div>
                <div class="col-md-3 form-group">
                    <?= Html::label('Giá gốc 1', 'productVersion_price_1') ?>
                    <?= NumberControl::widget([
                        'name' => 'productVersion_price_1',
                        'value' => '',
                        'maskedInputOptions' => [
                            'prefix' => '',
                            // 'suffix' => ' đ',
                            'allowMinus' => false,
                            'groupSeparator' => '.',
                            'radixPoint' => ','
                        ],
                        'options'=>['id'=>'productVersion_price_1'],
                        'displayOptions' => ['class' => 'form-control kv-monospace'],
                        'saveInputContainer' => ['class' => 'kv-saved-cont']
                    ]);?>


                </div>
                <div class="col-md-3 form-group">
                    <?= Html::label('Giá bán 1', 'productVersion_price_sale_1') ?>
                    <?= NumberControl::widget([
                        'name' => 'productVersion_price_sale_1',
                        'value' => '',
                        'maskedInputOptions' => [
                            'prefix' => '',
                            // 'suffix' => ' đ',
                            'allowMinus' => false,
                            'groupSeparator' => '.',
                            'radixPoint' => ','
                        ],
                        'options'=>['id'=>'productVersion_price_sale_1'],
                        'displayOptions' => ['class' => 'form-control kv-monospace'],
                        'saveInputContainer' => ['class' => 'kv-saved-cont']
                    ]); ?>
                </div>
                <div class="col-md-3 form-group">
                    <?= Html::label('Giá bán 2', 'productVersion_price_2') ?>
                    <?= NumberControl::widget([
                        'name' => 'productVersion_price_2',
                        'value' => '',
                        'maskedInputOptions' => [
                            'prefix' => '',
                            // 'suffix' => ' đ',
                            'allowMinus' => false,
                            'groupSeparator' => '.',
                            'radixPoint' => ','
                        ],
                        'options'=>['id'=>'productVersion_price_2'],
                        'displayOptions' => ['class' => 'form-control kv-monospace'],
                        'saveInputContainer' => ['class' => 'kv-saved-cont']
                    ]); ?>
                </div>
                <div class="col-md-3 form-group">
                    <?= Html::label('Giá bán 3', 'productVersion_price_3') ?>
                    <?= NumberControl::widget([
                        'name' => 'productVersion_price_3',
                        'value' => '',
                        'maskedInputOptions' => [
                            'prefix' => '',
                            // 'suffix' => ' đ',
                            'allowMinus' => false,
                            'groupSeparator' => '.',
                            'radixPoint' => ','
                        ],
                        'options'=>['id'=>'productVersion_price_3'],
                        'displayOptions' => ['class' => 'form-control kv-monospace'],
                        'saveInputContainer' => ['class' => 'kv-saved-cont']
                    ]); ?>
                </div>
                <div class="col-md-2">
                   <div class="form-group has-success">
                    <?= Html::label('Kích hoạt', 'proversionstatus',['style'=>'cursor: pointer;']) ?>
                    <br>
                    <label class="cbx-label" for="kv-adv-9">
                        <?= CheckboxX::widget([
                            'name' => 'productVersionStatus',
                            'value'=>1,
                            'initInputType' => CheckboxX::INPUT_CHECKBOX,
                            'options'=>['id'=>'proversionstatus'],
                            'pluginOptions' => [
                                    // 'theme' => 'krajee-flatblue',
                                'threeState'=>false,
                                    // 'enclosedLabel' => true
                            ]
                        ]); ?>

                        <!-- Success -->
                    </label>
                </div>
            </div>

            </div>
            <br>
            <div class="clearfix"></div>
            <div class="modal-footer">
                    <?= Html::button('Thêm mới', ['class' => 'btn btn-success','id'=>'UpdateVersionPro','data-product'=>$product_id,'data-id'=>$product_id,'data-url'=>'/quantri/products/product-versions/addnew','data-action'=>'create']) ?>
                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div> 
<style type="text/css">
    
</style>