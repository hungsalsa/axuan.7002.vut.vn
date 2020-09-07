<?php
use yii\widgets\ActiveForm;
?>
<div class="panel panel-primary attribute">
    <div class="panel-heading" style="height: 40px;padding: 10px;">&nbsp;
        <div class="panel-action active actioncollapse">
            <a href="javascript:void(0)" data-perform="panel-collapse" style="opacity: 1;"><label>Tùy chỉnh SEO</label><i class="ti-minus"></i></a> <a href="javascript:void(0)" data-perform="panel-dismiss" style="opacity: 1;"><i class="ti-close"></i></a></div>
        </div>
        <div class="panel-wrapper collapse in" aria-expanded="true">
            <div class="panel-body">
                <?= $form->field($model, 'title',['options'=>['class'=>'col-md-6']])->textInput(['maxlength' => true,'id'=>'seo_title'])?>
                
                <?= $form->field($model, 'keywords',['options'=>['class'=>'col-md-6']])->textarea(['rows' => 1]) ?>
                <div class="clearfix"></div>
                <?= $form->field($model, 'descriptions')->textarea(['rows' => 3]) ?>
            </div>
        </div>
    </div>
    
