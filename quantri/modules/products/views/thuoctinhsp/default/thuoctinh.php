<?php use yii\helpers\Url;
use kartik\select2\Select2;
use yii\helpers\Html; ?>

<div class="panel panel-primary attribute">
    <div class="panel-heading">Các phiên bản
        <div class="panel-action">
            <button type="button" data-url="<?= Url::to(['default/attribute']) ?>" id="add_new_attrubuteProduct" class="btn btn-success btn-circle btn-lg">Thêm <i class="ti-plus"></i> </button>
        </div>
    </div>
    <div class="panel-wrapper collapse in">
        <div class="panel-body" id="body_attributeProduct" style="padding: 0 10px;">
            <div class="table-responsive col-md-6">
                <table class="table color-bordered-table primary-bordered-table hover-table">
                    <tbody class="list_attribute">
                        
                    </tbody>
                </table>
            </div>
        </div>
        <div class="panel-footer">
            <div class="table-responsive">
                <table class="table color-bordered-table primary-bordered-table hover-table">
                    <tbody class="list_attribute" id="attribute_product_price_list">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="modal fade bs-example-modal-lg in" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalAttribute" data-keyboard="false">
        <modeiv class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title text-center" id="myLargeModalLabel">Thuộc tính sản phẩm</h4> </div>
                    <div class="modal-body" style="overflow: hidden;padding: 20px">

                        <?= Html::hiddenInput('product_id', $product_id, ['id' => 'attribute_product_id']) ?>
                        <div class="col-md-4">
                            <label class="control-label">Tên thuộc tính</label>
                            <?= Select2::widget([
                            'name' => 'attribute_name',
                            // 'value' => ['red', 'green'], // initial value
                            'data' => $data['productproperties'],
                            'maintainOrder' => true,
                            'options' => ['placeholder' => 'Select a color ...', 'multiple' => false,'id'=>'attribute_name'],
                            'pluginOptions' => [
                                'tags' => true,
                                'maximumInputLength' => 10
                            ],
                        ]); ?>
                        </div>
                        <div class="col-md-6">
                            <label class="control-label">Giá trị</label>
                            <?= Select2::widget([
                                'name' => 'attribute_values',
                                // 'value' => ['red', 'green'], // initial value
                                // 'data' => $data['productproperties'],
                                'maintainOrder' => true,
                                'options' => ['placeholder' => 'Select a color ...', 'multiple' => true,'id'=>'attribute_value'],
                                'pluginOptions' => [
                                    'tags' => true,
                                    'maximumInputLength' => 10
                                ],
                            ]); ?>
                        </div>
                        <div class="col-md-2">
                            <label class="control-label">&nbsp;</label>
                            <button class="fcbtn btn btn-info btn-outline btn-1d mr-5" id="themthuoctinh"  data-url="<?= Url::to(['danhsachthuoctinh/taothuoctinh']) ?>">Thêm thuộc tính</button>
                        </div>
                    </div>
                    <!-- <div class="modal-footer">data-dismiss="modal" 
                        <div class="form-group">
                        </div>
                    </div> -->
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
