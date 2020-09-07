<?php
use yii\widgets\ActiveForm;
?>
<div class="panel panel-primary attribute" style="margin-bottom:0">
    <!--<div class="panel-heading">
        <div class="panel-action active actioncollapse">
            <a href="javascript:void(0)" data-perform="panel-collapse" style="opacity: 1;"><label>SEO</label>
                <i class="ti-minus"></i></a> <a href="javascript:void(0)" data-perform="panel-dismiss" style="opacity: 1;">
            </a>
        </div>
    </div>-->
    <div class="panel-wrapper collapse in" aria-expanded="true">
        <div class="panel-body" style="padding:15px;">
            <?= $form->field($model, 'title',['options'=>['class'=>'col-md-12','style'=>'padding:0']])->textInput(['maxlength' => 60,'id'=>'seo_title','placeholder'=>'Seo Title'])?>
            <div class="clearfix"></div>
            <?= $form->field($model, 'descriptions')->textarea(['rows' => true,'maxlength' => 150,'placeholder'=>'Seo MetaDescription']) ?>
            <div class="clearfix"></div>
            <?= $form->field($model, 'keywords',['options'=>['class'=>'col-md-10','style'=>'padding-left:0']])->textarea(['rows' => 1,'placeholder'=>'Nhập 1 đến 2 từ khóa, cách nhau bởi dấu phẩy']) ?>
            <!-- Sắp xếp -->
            <?= $form->field($model, 'order',['options'=>['class'=>'col-md-2','style'=>'padding-right:0']])->textInput(['placeholder'=>'0']) ?>
        </div>
    </div>
</div>