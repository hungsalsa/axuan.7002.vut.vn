<?php
use yii\helpers\Html;
?>
<div class="table-responsive">
    <table class="table" cellspacing="14">
        <thead>
            <th width="10%" class="text-center">STT</th>
            <th class="text-center">Ảnh</th>
            <th class="text-center">Sắp xếp</th>
            <th width="20%" class="text-center">Action</th>
        </thead>
        <tbody id="body_images_list">
            <?php if (isset($listImages) && $listImages): //dbg($listImages)?>
                <?php foreach ($listImages as $keyimage => $value): ?>
                    <tr class="row_image" id="row_image_<?= $value->idIma ?>">
                        <td><?= $keyimage + 1 ?></td>
                        <td>
                            <img src="<?= $value->image ?>" height="60px" id="imageFile_<?= $value->idIma ?>">
                            <!-- <span><?= Yii::$app->formatter->asDatetime($value->created_at, "php:d-m-Y H:i:s") ?></span> -->
                            <span><?= Yii::$app->formatter->asDatetime($value->updated_at, "php:d-m-Y H:i:s") ?></span>
                        </td>
                        <td>
                            <?= $value->order ?>
                        </td>

                        <td>
                            <!-- <a href="javascript:void(0)" data-toggle="tooltip" data-id="<?=$value->idIma ?>" data-original-title="Edit" class="EditProImage"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a> -->
                             <a onclick="editImagePro(<?= $value->idIma ?>)" href="javascript:void(0)" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>
                            <a onclick="deleteImagePro(<?=$value->idIma ?>)" href="javascript:void(0)" data-toggle="tooltip" data-original-title="Close"> <i class="fa fa-close text-danger"></i> </a>
                        </td>
                    </tr>
                <?php endforeach ?>
            <?php endif ?>
        </tbody>
    </table>
</div>
<div class="modal fade bd-example-modal-lg" tabindex="-1" data-keyboard="true" data-backdrop=false role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalAddImages">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="modalAddImages_content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title text-center" id="myLargeModalLabel">Thêm ảnh sản phẩm</h4> </div>
            <div class="modal-body" style="overflow: hidden;">
                    <?= Html::hiddenInput('product_id', $product_id, ['class' => 'form-control','id'=>'imageProduct_id']) ?>
                    <?= Html::hiddenInput('imageId', '', ['class' => 'form-control','id'=>'imageId']) ?>
                    <?= Html::hiddenInput('action', '', ['class' => 'form-control','id'=>'imageAction']) ?>

                <div class="col-md-6">
                    <?= Html::label('Ảnh', 'imageFile') ?>
                    <?= Html::textInput('imageProduct', null, ['class' => 'form-control','id'=>'imageFile','placeholder'=>'Chọn ảnh']) ?>
                </div>
                <div class="col-md-6" style="height: 80px">
                    <img src="<?= (isset($model->image))? Yii::$app->request->hostInfo.$model->image:''?>" id="previewImage" alt="" style="height: 100%">
                </div>
                <div class="col-md-5">
                    <?= Html::label('Alt', 'imagealt') ?>
                    <?= Html::textInput('alt', null, ['class' => 'form-control','id'=>'imagealt','placeholder'=>'Seo Alt - Google đọc ảnh qua thẻ này']) ?>
                </div>
                <div class="col-md-5">
                    <?= Html::label('Title', 'imagetitle') ?>
                    <?= Html::textInput('title', null, ['class' => 'form-control','id'=>'imagetitle','placeholder'=>'Hiển thị khi rê chuột vào ảnh']) ?>
                </div>
                <div class="col-md-2">
                    <?= Html::label('Sắp xếp', 'imageorder') ?>
                    <?= Html::textInput('order', null, ['class' => 'form-control','id'=>'imageorder','type'=>'number',"step"=>"any",'placeholder'=>'0']) ?>
                </div>

               

            </div>
            <br>
            <div class="clearfix"></div>
            <div class="modal-footer">
                    <?= Html::button('Thêm mới', [
                        // 'onclick'=>"updateImage()",
                        'class' => 'btn btn-success','id'=>'UpdateImagePro','data-proid'=>$product_id,'data-id'=>'','data-url'=>'/quantri/products/anhsanpham/image'
                    ]) ?>
                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Đóng</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>