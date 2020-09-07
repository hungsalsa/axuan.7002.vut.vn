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
// $this->registerCssFile("@web/css/components/product.css");
?>

    <div class="products-form">

        <?php $form = ActiveForm::begin([
            'id' => 'dynamic-form'
        ]); ?>
            <div class="col-md-9">

                <div class="panel panel-default" style="position: static; zoom: 1;">
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <?= $form->field($model, 'pro_name',['options'=>['class'=>'col-md-6']])->textInput(['maxlength' => true,'id'=>'name_slug']) ?>
                            <?= $form->field($model, 'slug',['options'=>['class'=>'col-md-6']])->textInput(['maxlength' => true,'id'=>'seo_slug'])?>
                                <div class="clearfix"></div>
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"> Chi tiết</span></a></li>
                                    <li role="presentation" class=""><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Tab2</span></a></li>
                                    <li role="presentation" class=""><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-email"></i></span> <span class="hidden-xs">Tab3</span></a></li>
                                </ul>
                                <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="home">
                                    <?= $form->field($model, 'content')->textarea(['rows' => 6,'class'=>'content'])->label(false) ?>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="profile">
                                    <?= $form->field($model, 'tab2')->textarea(['rows' => 6,'class'=>'content'])->label(false) ?>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="messages">
                                    <?= $form->field($model, 'tab3')->textarea(['rows' => 6,'class'=>'content'])->label(false) ?>
                                </div>
                            </div>
                            <div class="clearfix"></div>

                            <a href="javasript:void(0)" class="add_short_description">Thêm mô tả ngắn</a>
                            <?= $form->field($model, 'short_introduction',['options'=>['id' => 'product_short_introduction']])->textarea(['rows' => 4,'class'=>'content']) ?>

                        </div>
                    </div>
                </div>
                <?php if ($this->context->action->id=='update'): ?>
                    <div class="panel panel-default imageversions">
                            <div class="panel-heading navpillslist">
                                <ul class="nav nav-pills">
                                    <li onclick="clicktabversion('productNewImage','productVersion')" class="active" id="navpillsImage"><a href="#navpills-1" data-toggle="tab" aria-expanded="false">Ảnh sản phẩm</a> </li>
                                    <li onclick="clicktabversion('productVersion','productNewImage')" class="" id="navpillsViersion"> <a href="#navpills-2" data-toggle="tab" aria-expanded="false">Các phiên bản sản phẩm</a> </li>
                                    <!-- <li> <a href="#navpills-3" data-toggle="tab" aria-expanded="true">Tab Three</a> </li> -->
                                </ul>
                                <button type="button" id="productNewImage" data-toggle="modal" data-target="#modalAddImages"  class="btn btn-success btn-circle btn-lg">Thêm <i class="ti-plus"></i> </button>
                                <button type="button" id="productVersion" data-toggle="modal" data-target="#modalProductVersion" class="btn btn-success btn-circle btn-lg">Thêm <i class="ti-plus"></i> </button>
                            </div>
                            <div class="panel-body">
                                
                                <div class="tab-content br-n pn">
                                    <div id="navpills-1" class="tab-pane active">
                                        <div class="row">
                                            <?= $this->render('_form-images', [
                                                'listImages' => $listImages,
                                                'product_id' => $model->id,
                                            ]) ?>
                                        </div>
                                    </div>
                                    <div id="navpills-2" class="tab-pane">
                                        <div class="row">
                                            <?= $this->render('_form_phienban', [
                                                'productVersions' => $productVersions,
                                                'product_id' => $model->id,
                                            ]) ?>
                                        </div>
                                    </div>
                                    <div id="navpills-3" class="tab-pane">
                                        <div class="row">
                                            <div class="col-md-4"> <img src="../plugins/images/large/img3.jpg" class="img-responsive thumbnail mr25"> </div>
                                            <div class="col-md-8"> Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica.
                                                <p>
                                                    <br/> Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php endif ?>

                    <?= $this->render('_form_seo', [
                        'model' => $model,
                        'form' => $form,
                    ]) ?>

                <div class="panel panel-info" style="positino: static; zoom: 1;">
                    <div class="panel-heading" style="height: 40px;padding: 10px;">
                        <div class="panel-action active" style="width: 100%;float: none;">
                            <a href="javascript:void(0)" data-perform="panel-collapse" style="opacity: 1;">
                                <label style="width:95%;font-weight: 600;">Sản phẩm & Tin tức liên quan</label><i class="ti-minus"></i></a> <a href="javascript:void(0)" data-perform="panel-dismiss" style="opacity: 1;"><i class="ti-close"></i></a>
                            </div>
                    </div>

                    <div class="panel-wrapper collapse <?= ($model->related_articles != ''||$model->related_products != '')? 'in':'' ?>">
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

                            <?= $form->field($model, 'related_albums')->widget(Select2::classname(), [
                                'data' => $data['albums'],
                                'language' => 'vi',
                                'options' => ['placeholder' => 'Select a related_albums ...', 'multiple' => true],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]);
                            ?>
                            <?= $form->field($model, 'related_downloads')->widget(Select2::classname(), [
                                'data' => $data['downloads'],
                                'language' => 'vi',
                                'options' => ['placeholder' => 'Select a related_downloads ...', 'multiple' => true],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]);
                            ?>
                        </div>
                    </div>
                </div>


            </div>
            <!-- END CONTENT INNER -->
            <div class="col-md-3">
                <div class="panel panel-default" style="positino: static; zoom: 1;">
                    <div class="panel-heading">Trạng thái</div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <?= $form->field($model, 'status',['options' => ['id' => 'product_status','class' => 'text-center text-info']])->widget(CheckboxX::classname(),
                                [
                                    'initInputType' => CheckboxX::INPUT_CHECKBOX,
                                    'options'=>['value' => $model->status],
                                    'pluginOptions'=>['threeState'=>false]
                                ])->label(false);
                                ?>
                                <!-- <a href="javasript:void(0)" id="show_product_time_status">Đặt lịch hiển thị</a> -->
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
                                        'options' => ['placeholder' => 'Nếu trống lấy giá gốc'],
                                        'pluginOptions' => [
                                            'autoclose'=>true,
                                            'todayHighlight' => true,
                                            'todayBtn' => true,
                                            'format' => 'dd-mm-yyyy'
                                        ]
                                    ]); ?>
                                            <?=  $form->field($model, 'end_sale',['options'=>['class'=>'col-md-11']])->widget(DatePicker::classname(), [
                                        'options' => ['placeholder' => 'Nếu trống lấy giá gốc'],
                                        'pluginOptions' => [
                                            'autoclose'=>true,
                                            'todayHighlight' => true,
                                            'todayBtn' => true,
                                            'format' => 'dd-mm-yyyy'
                                        ]
                                    ]); ?>
                                    

                            </div>
                        </div>
                    </div>

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
                                
                                <span class="boder-buttom clearfix col-md-12"></span>
                                <?= $form->field($model, 'product_category_id',['options'=>['class'=>'col-md-11']])->widget(Select2::classname(), [
                                    'data' => $data['category'],
                                    'options' => ['placeholder' => 'Select a color ...'],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]) ?>

                                <?= $form->field($model, 'tags',['options'=>['class'=>'col-md-11']])->widget(Select2::classname(), [
                                    'data' => $data['tags'],
                                    'options' => ['placeholder' => 'Select a Tags', 'multiple' => true],
                                    'pluginOptions' => [
                                        'tags' => true,
                                        'allowClear' => true
                                    ],
                                ]) ?>


                        </div>
                    </div>
                </div>
                    <div class="thongsokythuat">
                        <?php DynamicFormWidget::begin([
                        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                        'widgetBody' => '.container-items', // required: css class selector
                        'widgetItem' => '.item', // required: css class
                        'limit' => 50, // the maximum times, an element can be added (default 999)
                        'min' => 0, // 0 or 1 (default 1)
                        'insertButton' => '.add-item', // css class
                        'deleteButton' => '.remove-item', // css class
                        'model' => $modelsProductThuoctinh[0],
                        'formId' => 'dynamic-form',
                        'formFields' => [
                            'name',
                            'value',
                            'sort',
                        ],
                    ]); ?>

                    <div class="panel panel-default thongsokythuat">
                        <div class="panel-heading"><i class="glyphicon glyphicon-envelope"></i> Thuộc tính &emsp;&emsp;&emsp;
                            <div class="panel-action">
                                <button type="button" class="add-item fcbtn btn btn-danger btn-outline btn-1d">
                                    <i class="glyphicon glyphicon-plus"><label class="">Add</label></i> 
                                </button>
                                <a href="javascript:void(0)" data-perform="panel-collapse"><i class="ti-minus"></i></a> <a href="javascript:void(0)" data-perform="panel-dismiss"><i class="ti-close"></i></a>
                            </div>
                        </div>
                        <div class="panel-wrapper collapse in">

                            <div class="panel-body" style="background: #89878780;padding: 0;">
                                <div class="container-items"><!-- widgetBody -->
                                    <?php foreach ($modelsProductThuoctinh as $i => $modelThuoctinh): ?>
                                        <div class="item panel panel-default"><!-- widgetItem -->
                                            
                                                <div class="panel-body">
                                                    <?php
                                            // necessary for update action.
                                                    if (! $modelThuoctinh->isNewRecord) {
                                                        echo Html::activeHiddenInput($modelThuoctinh, "[{$i}]id");
                                                    }
                                                    ?>
                                                    <div class="row">
                                                        <?= $form->field($modelThuoctinh, "[{$i}]name",['options'=>['class'=>'col-md-12']])->widget(Select2::classname(), [
                                                            'data' => $data['productproperties'],
                                                            'options' => ['placeholder' => 'Select a color ...','class'=>'modelThuoctinhName'],
                                                            'pluginOptions' => [
                                                                'allowClear' => true,
                                                                'tags' => true,
                                                            ],
                                                        ]) ?>
                                                        <?= $form->field($modelThuoctinh, "[{$i}]value",['options'=>['class'=>'col-md-10']])->textInput(['maxlength' => true]) ?>

                                                        <?= $form->field($modelThuoctinh, "[{$i}]sort",['options'=>['class'=>'col-md-10']])->textInput(['maxlength' => true,'type' => 'number']) ?>


                                                        
                                                        <div class="pull-right col-md-2">
                                                            <br>
                                                            <button type="button" class="remove-item btn btn-danger btn-xs" style="margin-top: 6px"><i class="glyphicon glyphicon-minus"></i></button>
                                                        </div>
                                                    </div>
                                                </div><!-- .row -->
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                            </div>
                        </div>
                    </div><!-- .panel -->
                    <?php DynamicFormWidget::end(); ?>
                </div>
            </div>
    
            <div class="form-group btn_save">
                <?= Html::submitButton($model->isNewRecord ? 'Thêm mới':'Chỉnh sửa', ['class' => 'btn btn-info btn_luu']) ?>
                <?= Html::resetButton(Yii::t('app', 'Reset'), ['name' => 'Hủy', 'class' => 'btn btn-primary btn_luu']) ?>
                <?= Html::a('Về danh sách', ['/products/default'], ['class'=>'btn btn-danger btn_luu']) ?>
            </div>

            <?php ActiveForm::end(); ?>

    </div>


    <?php



// $this->registerCssFile('@web/plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css');

$this->registerCssFile('@web/css/components/product.css');

// $this->registerJsFile("@web/plugins/bower_components/dropzone-master/dist/dropzone.js");
$this->registerJsFile("@web/tinymce/tinymce.min.js", ['depends' => [yii\web\JqueryAsset::className()]]);
// $this->registerJsFile("@web/js/jquery.fileupload.js", ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/js/yii2-dynamic-form.js', ['depends' => [\yii\web\JqueryAsset::class]] ); 
$this->registerJsFile("@web/js/bootstrap-notify.js", ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerJsFile("@web/js/main.js", ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerJsFile("@web/js/product/product.js", ['depends' => [yii\web\JqueryAsset::className()]]);
?>
<?php 
if(Yii::$app->session->hasFlash('messeage')){
    $messeage = Yii::$app->session->getFlash('messeage');
}
if(isset($messeage)): 
    ?>
<script type="text/javascript">
    $.notify({
        icon: 'pe-7s-gift',
        message: "<?= $messeage ?>"

    },{
        type: 'info',
        timer: 200
    });
</script>
<?php endif; ?>