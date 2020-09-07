<?php
use yii\helpers\Html;
?>
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h4 class="modal-title text-center" id="myLargeModalLabel">Thêm ảnh sản phẩm</h4> </div>
<div class="modal-body" style="overflow: hidden;">
    <?= Html::hiddenInput('product_id', $data->pro_id, ['class' => 'form-control','id'=>'imageProduct_id']) ?>

    <div class="col-md-6">
        <?= Html::label('Ảnh', 'imageFile') ?>
        <?= Html::textInput('imageProduct', $data->pro_id, ['class' => 'form-control','id'=>'imageFile','placeholder'=>'Chọn ảnh']) ?>
    </div>
    <div class="col-md-6" style="height: 80px">
        <img src="<?= (isset($model->image))? Yii::$app->request->hostInfo.$model->image:''?>" id="previewImage" alt="" style="height: 100%">
    </div>
    <div class="col-md-5">
        <?= Html::label('Alt', 'imagealt') ?>
        <?= Html::textInput('alt', $data->pro_id, ['class' => 'form-control','id'=>'imagealt','placeholder'=>'Seo Alt - Google đọc ảnh qua thẻ này']) ?>
    </div>
    <div class="col-md-5">
        <?= Html::label('Title', 'imagetitle') ?>
        <?= Html::textInput('title', $data->pro_id, ['class' => 'form-control','id'=>'imagetitle','placeholder'=>'Hiển thị khi rê chuột vào ảnh']) ?>
    </div>
    <div class="col-md-2">
        <?= Html::label('Sắp xếp', 'imageorder') ?>
        <?= Html::textInput('order', $data->pro_id, ['class' => 'form-control','id'=>'imageorder','type'=>'number',"step"=>"any",'placeholder'=>'0']) ?>
    </div>



</div>
<br>
<div class="clearfix"></div>
<div class="modal-footer">
    <?= Html::button('Thêm mới', [
                        // 'onclick'=>"updateImage()",
        'class' => 'btn btn-success','id'=>'UpdateImagePro','data-proid'=>$data->pro_id,'data-id'=>$data->idIma,'data-url'=>'/quantri/products/anhsanpham/image','data-action'=>'update'
    ]) ?>
    <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Đóng</button>
</div>