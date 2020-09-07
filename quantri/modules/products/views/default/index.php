<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\number\NumberControl;

$this->title = 'Danh sách sản phẩm';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="btn_save">
        <?= Html::a('Thêm mới', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => "Từ {begin} đến {end} trong tổng {totalCount} sản phẩm",
        'tableOptions' => ['class' => 'table table-bordered table-hover'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'code',
            [
               'attribute' => 'pro_name',
               'format' => 'raw',
               'value'=>function ($data) {
                return Html::a(Html::encode($data->pro_name),Url::to(['default/update','id'=>$data->id],true)) ; //id='.$data->id);
                },
            ],
            // 'pro_name_not',
            /*[
                'attribute' =>'pro_name',
                'format'=>'html',
                'content' => function($model,$key,$index, $column) {
                    $html = "<div class=\"col-md-12 updateProduct$key proUpdate\">".
                    Html::textInput('pro_name', $model->pro_name, ['class'=>'form-control col-md-4','id'=>'pro_name'.$key]).
                    Html::button('Save',$options = ['class'=>'btn btn-info btn-outline col-md-5 savecateName',"data-url"=>Yii::$app->getUrlManager()->createUrl(['/quantri/product/quickchange']),'data-id'=>$key,'data-field'=>'pro_name']).
                    Html::button('Cancel',$options = ['class'=>'btn btn-default btn-outline col-md-6 Cancel','style'=>'margin:2px']).
                    
                    "</div>";
                    return Html::button($model->pro_name,$options = [
                        'data-field'=>'pro_name',
                        'data-id'=>$key,
                        'id'=>'buttonpro_name'.$key,
                        'class'=>'btn btn-block btn-outline btnName Quickchange change',
                    ]).$html;
                },
            ],*/
            // 'title',
            // 'slug',
            //'keywords:ntext',
            //'descriptions:ntext',
            //'short_introduction:ntext',
            //'content:ntext',
            [
                'attribute' =>'price',
                'format'=>'html',
                'contentOptions' => ['class' => 'text-right','style' => 'width:8%'],
                'content' => function($model,$key,$index, $column) {
                    $html = "<div class=\"col-md-12 updateProduct$key proUpdate\">".
                    NumberControl::widget([
                        'name' => 'price',
                        'value' => $model->price,
                        'maskedInputOptions' => [
                            'prefix' => '',
                            // 'suffix' => ' đ',
                            'allowMinus' => false,
                            'groupSeparator' => '.',
                            'radixPoint' => ','
                        ],
                        'options'=>['id'=>'price'.$key],
                        'displayOptions' => ['class' => 'form-control kv-monospace'],
                        'saveInputContainer' => ['class' => 'kv-saved-cont']
                    ])
                    .Html::button('Save',$options = ['class'=>'btn btn-info btn-outline col-md-5 savecateName',"data-url"=>Yii::$app->getUrlManager()->createUrl(['/products/default/quickchange']),'data-id'=>$key,'data-field'=>'price']).
                    Html::button('Cancel',$options = ['class'=>'btn btn-default btn-outline col-md-6 Cancel','style'=>'margin:2px']).
                    
                    "</div>";
                    return Html::button(Yii::$app->formatter->asDecimal($model->price,0),$options = [
                        'data-field'=>'price',
                        'data-id'=>$key,
                        'id'=>'buttonprice'.$key,
                        'class'=>'btn btn-block btn-outline btn-info Quickchange change',
                    ]).$html;
                },
            ],
            [
                'attribute' =>'price_sales',
                'contentOptions' => ['class' => 'text-right','style' => 'width:8%'],
                'format'=>'html',
                'content' => function($model,$key,$index, $column) {
                    $html = "<div class=\"col-md-12 updateProduct$key proUpdate\">".
                    NumberControl::widget([
                        'name' => 'price_sales',
                        'value' => $model->price_sales,
                        'maskedInputOptions' => [
                            'prefix' => '',
                            // 'suffix' => ' đ',
                            'allowMinus' => false,
                            'groupSeparator' => '.',
                            'radixPoint' => ','
                        ],
                        'options'=>['id'=>'price_sales'.$key],
                        'displayOptions' => ['class' => 'form-control kv-monospace'],
                        'saveInputContainer' => ['class' => 'kv-saved-cont']
                    ])
                    .Html::button('Save',$options = ['class'=>'btn btn-info btn-outline col-md-5 savecateName',"data-url"=>Yii::$app->getUrlManager()->createUrl(['/products/default/quickchange']),'data-id'=>$key,'data-field'=>'price_sales']).
                    Html::button('Cancel',$options = ['class'=>'btn btn-default btn-outline col-md-6 Cancel','style'=>'margin:2px']).
                    
                    "</div>";
                    return Html::button(Yii::$app->formatter->asDecimal($model->price_sales,0),$options = [
                        'data-field'=>'price_sales',
                        'data-id'=>$key,
                        'id'=>'buttonprice_sales'.$key,
                        // 'class'=>'btn btn-block btn-outline btn-info Quickchange change',
                    ]).$html;
                },
            ],
            
            //'start_sale',
            //'end_sale',
            // 'order',
            [
                'attribute' =>'order',
                'contentOptions' => ['class' => 'text-center','style' => 'width:6%'],
                'format'=>'html',
                'content' => function($model,$key,$index, $column) {
                    $html = "<div class=\"updateProduct$key proUpdate\">".
                    Html::textInput('order', $model->order, ['max' => 998,'class'=>'form-control col-md-4','id'=>'order'.$key,'type'=>'number']).
                    Html::button('Save',$options = ['class'=>'btn btn-info btn-outline col-md-5 saveOrder',"data-url"=>Yii::$app->getUrlManager()->createUrl(['/products/default/quickchange']),'data-id'=>$key]).
                    Html::button('Cancel',$options = ['class'=>'btn btn-default btn-outline col-md-6 Cancel','style'=>'margin:2px']).
                    
                    "</div>";
                    return Html::button($model->order,$options = [
                        'data-field'=>'order',
                        'data-id'=>$key,
                        'id'=>'buttonOrder'.$key,
                        'class'=>'btn btn-block btn-outline btn-primary Quickchange change',
                    ]).$html;
                },
            ],
            //'product_type_id',
            //'supplier_id',
            //'warranty_period',
            //'models_id',
            'views',
            //'image',
            //'images_list',
            //'tags',
            [
                'attribute'=>'product_category_id',
                'value'=>'productCategory.cateName'
            ],

            
            //'related_articles:ntext',
            //'related_products:ntext',
            [
                'attribute' =>'hot',
                'contentOptions' => ['class' => 'text-center','style'=>'width:5%'],
                'format'=>'html',
                'content' => function($model,$key,$index, $column) {
                    $classbtn = ($model->hot==0)? 'btn-danger':'btn-success';
                    return Html::button(($model->hot==0)?' Không ':' Có ',$options = [
                        'data-id'=>$key,
                        'data-field'=>'hot',
                        'id'=>'hot'.$key,
                        "data-url"=>Yii::$app->getUrlManager()->createUrl(['/products/default/statuschange']),
                        "class"=>"btn btn-block btn-outline $classbtn Quickactive change",
                    ]);
                },
            ],
            [
                'attribute' =>'status',
                'contentOptions' => ['class' => 'text-center','style'=>'width:5%'],
                'format'=>'html',
                'content' => function($model,$key,$index, $column) {
                    $classbtn = ($model->status==0)? 'btn-danger':'btn-success';
                    return Html::button(($model->status==0)?' Ẩn ':'Hiện',$options = [
                        'data-id'=>$key,
                        'data-field'=>'status',
                        'id'=>'status'.$key,
                        "data-url"=>Yii::$app->getUrlManager()->createUrl(['/products/default/statuschange']),
                        "class"=>"btn btn-block btn-outline $classbtn Quickactive change",
                    ]);
                },
            ],
            //'time_status:datetime',
            //'created_at',
            [
                'attribute'=>'updated_at',
                'format'=>'datetime',
                'contentOptions' => ['class' => 'text-center','style' => 'width:9%'],
            ],
            //'userCreated',
            //'userUpdated',

            // ['class' => 'yii\grid\ActionColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'headerOptions' => ['style' => 'color:#337ab7;width: 6%','class'=>'text-center'],
                'contentOptions' => ['class' => 'text-center actionColumn','style' => 'font-size:18px'],
                'template' => '{double}{delete}',//{view}{update}
                'visibleButtons' => [
                    'view' => Yii::$app->user->can('quantri/product/view'),
                    'update' => Yii::$app->user->can('quantri/product/update'),
                    'delete' => Yii::$app->user->can('quantri/product/delete')
                ],
                'buttons' => [
                    'double' => function ($url, $model) {
                        return Html::a('<span class="ti-layers-alt"></span>', $url, [
                            'title' => Yii::t('app', 'Nhân bản'),
                        ]);
                    },
                    /*'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                            'title' => Yii::t('app', 'lead-view'),
                        ]);
                    },

                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                            'title' => Yii::t('app', 'lead-update'),
                        ]);
                    },
                    */
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete'], [
                            'title' => Yii::t('app', 'Xóa'),
                            'data' => [
                                'confirm' => 'Bạn muốn xóa sản phẩm này?',
                                'method' => 'post',
                                'params' => ['id'=>$model->id],
                            ],
                        ]);
                        // return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                        //     'title' => Yii::t('app', 'lead-delete'),
                        // ]);
                    }

                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
<?php 
$this->registerJsFile('@web/js/bootstrap-notify.min.js', ['depends' => [\yii\web\JqueryAsset::class]] );
$this->registerJsFile('@web/js/product/global.js', ['depends' => [\yii\web\JqueryAsset::class]] );
// $this->registerJsFile('@web/js/product/menu_index.js', ['depends' => [\yii\web\JqueryAsset::class]] );
$this->registerJsFile('@web/js/product/productcategory_index.js', ['depends' => [\yii\web\JqueryAsset::class]] );?>