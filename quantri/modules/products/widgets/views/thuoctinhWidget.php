<?php use yii\helpers\Url; ?>
<div class="panel panel-primary attribute">
    <div class="panel-heading">Thuộc tính
        <div class="panel-action">
            <button type="button" data-url="<?= Url::to(['default/attribute']) ?>" id="add_new_attrubuteProduct" class="btn btn-success btn-circle btn-lg">Thêm <i class="ti-plus"></i> </button>
        </div>
    </div>
    <div class="panel-wrapper collapse in">
        <div class="panel-body" id="body_attributeProduct">

        </div>
        <div class="panel-footer"> Panel Footer </div>
    </div>
</div>

<div class="panel panel-default" style="positino: static; zoom: 1;">
    <div class="panel-heading" style="height: 40px;">
        <div class="panel-action active" style="width: 100%;">
            <a href="javascript:void(0)" data-perform="panel-collapse">
                <label style="width:95%;font-weight: 600;">Thông số kỹ thuật</label><i class="ti-minus"></i></a> <a href="javascript:void(0)" data-perform="panel-dismiss"><i class="ti-close"></i></a>
            </div>
        </div>

        <div class="panel-wrapper collapse in">
            <div class="panel-body">
                
            </div>
        </div>
    </div>