<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\select2\Select2;
$this->title = 'Danh sách Modules';
$this->params['breadcrumbs'][] = $this->title;
// $type_show = Yii::$app->params['hienthi']['news'];
$page_show = Yii::$app->params['modules']['page_show']
?>
<div class="setting-modules-index">

    <h1><?= Html::encode($this->title) ?> </h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="btn_save">
        <?= Html::a('Thêm mới', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        // 'summary' => "Khách hàng từ {begin} -> {end} trong tổng {totalCount} khách hàng",
        'tableOptions' => ['class' => 'table table-bordered table-hover'],
        // 'rowOptions' => function ($model, $key, $index, $grid) {
        //     return [
        //         'style' => "cursor: pointer",
        //         'id' => $model['id'], 
        //         'onclick' => 'location.href="'
        //         . Yii::$app->urlManager->createUrl('setting/setting-modules/view')
        //         . '?id="+(this.id);',
        //     ];
        // },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [
                'attribute' =>'name',
                'format'=>'html',
                'content'=> function ($model) {
                    return Html::a($model->name, ['setting-modules/view','id'=>$model->id], [
                        'title' => Yii::t('app', 'lead-view'),
                    ]);
                }
            ],
            // 'name',

            /*[
                'attribute' =>'name',
                'contentOptions' => ['class' => 'text-center'],
                'format'=>'html',
                'content' => function($model,$key,$index, $column) {
                    $html = "<div class=\"col-md-12 updateProduct$key proUpdate\">".
                    Html::textInput('name', $model->name, ['class'=>'form-control col-md-4','id'=>'name'.$key]).
                    Html::button('Save',$options = ['class'=>'btn btn-info btn-outline col-md-5 savecateName',"data-url"=>Yii::$app->getUrlManager()->createUrl(['/setting/setting-modules/quickchange']),'data-id'=>$key,'data-field'=>'name']).
                    Html::button('Cancel',$options = ['class'=>'btn btn-default btn-outline col-md-6 Cancel','style'=>'margin:2px']).
                    
                    "</div>";
                    return Html::button($model->name,$options = [
                        'data-field'=>'name',
                        'data-id'=>$key,
                        'id'=>'buttonname'.$key,
                        'class'=>'btn btn-block btn-outline btnName Quickchange change',
                    ]).$html;
                },
            ],*/
            [
                'attribute' =>'positions',
                'contentOptions' => ['class' => 'text-center'],
                // 'format'=>'html',
                // 'content' => function($model,$key,$index, $column) {
                //     $html = "<div class=\"col-md-12 updateProduct$key proUpdate\">".
                //     Html::textInput('positions', $model->positions, ['class'=>'form-control col-md-4','id'=>'positions'.$key]).
                //     Html::button('Save',$options = ['class'=>'btn btn-info btn-outline col-md-5 savecateName',"data-url"=>Yii::$app->getUrlManager()->createUrl(['/setting/setting-modules/quickchange']),'data-id'=>$key,'data-field'=>'positions']).
                //     Html::button('Cancel',$options = ['class'=>'btn btn-default btn-outline col-md-6 Cancel','style'=>'margin:2px']).
                    
                //     "</div>";
                //     return Html::button($model->positions,$options = [
                //         'data-field'=>'positions',
                //         'data-id'=>$key,
                //         'id'=>'buttonname'.$key,
                //         'class'=>'btn btn-block btn-outline btnName Quickchange change',
                //     ]).$html;
                // },
            ],
            'type_module',
            // 'cate_id',
            [
                'attribute' =>'cate_id',
                'content' =>function ($data)
                {
                    switch ($data->type_module) {
                        case 'product':
                        {
                            if ($data->category) {
                                return ($data->category) ? $data->category->cateName: null;
                            } else {
                                return '';
                            }
                            break;
                        }
                        case 'news':
                            return ($data->dmuctin) ? $data->dmuctin->cateName: null;
                            break;
                        
                        default:
                            return null;
                            // return $data->cate_id;
                            break;
                    }
                }
            ],

            [
               'attribute' => 'hienthi',
               'format' => 'raw',
               'value'=>function ($data) {
                    if ($data->type_module=='news') {
                        if ($data->hienthi=='') {
                            return '';
                        } else {
                            return Yii::$app->params['hienthi']['news'][$data->hienthi];
                        }
                    }elseif ($data->type_module=='product') {
                        if ($data->hienthi=='') {
                            return '';
                        } else {
                            return Yii::$app->params['hienthi']['products'][$data->hienthi];
                        }
                    } else {
                        return $data->hienthi;
                    }
                },
            ],
            
            // 'cate_slug',
            // 'hienthi',
            // 'parent_id',
            /*[
                'attribute' =>'cate_slug',
                // 'headerOptions' => ['width' => '20%'],
                'format'=>'html',
                'content' => function($model,$key,$index, $column) use($dataCategory){
                    
                    $html = "<div class=\"updateProduct$key proUpdate\">".
                    Select2::widget([
                        'name' => 'cate_slug',
                        'value' => $model->cate_slug,
                        'data' => $dataCategory,
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                        'options' => [
                             // 'allowClear'=> true,
                            'id'=>'cate_slug'.$key,
                            'class'=>'form-control',
                            'placeholder' => 'Select provinces ...',
                        ],
                    ]).
                    Html::button('Save',$options = ['class'=>'btn btn-info btn-outline col-md-5 m-3 savecateName','style'=>'margin:2px',"data-url"=>Yii::$app->getUrlManager()->createUrl(['/setting/setting-modules/quickchange']),'data-id'=>$key,'data-field'=>'cate_slug']).
                    Html::button('Cancel',$options = ['class'=>'btn btn-default btn-outline col-md-6 m-3 Cancel','style'=>'margin:2px']).
                    "</div>";

                    return Html::button($dataCategory[$model->cate_slug],
                        $options = [
                        'data-id'=>$key,
                        'data-field'=>'cate_slug',
                        'id'=>'menuName'.$key,
                        'class'=>'text-info btn btn-outline btn-info Quickchange change text-primary',
                    ]).$html;
                },
            ],*/
            [
                'attribute' =>'order',
                'contentOptions' => ['class' => 'text-center','style' => 'width:6%'],
                'format'=>'html',
                'content' => function($model,$key,$index, $column) {
                    $html = "<div class=\"updateProduct$key proUpdate\">".
                    Html::textInput('order', $model->order, ['max' => 998,'class'=>'form-control col-md-4','id'=>'order'.$key]).
                    Html::button('Save',$options = ['class'=>'btn btn-info btn-outline col-md-5 saveOrder',"data-url"=>Yii::$app->getUrlManager()->createUrl(['/setting/setting-modules/quickchange']),'data-id'=>$key]).
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
            [
                'attribute' =>'status',
                'contentOptions' => ['class' => 'text-center','style'=>'width:5%'],
                'format'=>'html',
                'content' => function($model,$key,$index, $column) {
                    $classbtn = ($model->status==0)? 'btn-danger':'btn-success';
                    // $quickActive = ($model->cate_id == 0 ) ? '' :'Quickactive';
                    return Html::button(($model->status==0)?' Ẩn ':'Hiện',$options = [
                        'data-field'=>'status',
                        'data-id'=>$key,
                        'id'=>'status'.$key,
                        "data-url"=>Yii::$app->getUrlManager()->createUrl(['/setting/setting-modules/statuschange']),
                        "class"=>"btn btn-block btn-outline $classbtn Quickactive change",
                    ]);
                },
            ],
            [
               'attribute' => 'page_show',
               'format' => 'raw',
               'value'=>function ($model) use ($page_show) {
                    $hienthi= json_decode($model->page_show);
                    if (is_array($hienthi)) {
                        foreach ($hienthi as $key => $value) {
                            $hienthi[$key] = isset($page_show[$value])? $page_show[$value] : $value;
                        }
                        $hienthi = implode("; ",$hienthi); 
                        return $hienthi;
                    }else {
                        return $model->page_show;
                    }
               }
           ],

            //'sort',
            //'positions',
            //'content:ntext',
            //'created_at',
            //'updated_at',
            //'userCreated',
            //'userUpdated',

             [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'headerOptions' => ['style' => 'color:#337ab7;width: 8%','class'=>'text-center'],
                'contentOptions' => ['class' => 'actionColumn text-center','style' => 'font-size:18px'],
                'template' => '{view}  {update}  {delete}',
                'visibleButtons' => [
                    'view' => Yii::$app->user->can('setting/setting-modules/view'),
                    'update' => Yii::$app->user->can('setting/setting-modules/update'),
                    'delete' => Yii::$app->user->can('setting/setting-modules/delete')
                ],
            ],
        ],
    ]); ?>
</div>
    <?php Pjax::end(); ?>
</div>
<?php 
$this->registerJsFile('@web/js/product/global.js', ['depends' => [\yii\web\JqueryAsset::class]] );
$this->registerJsFile('@web/js/product/productcategory_index.js', ['depends' => [\yii\web\JqueryAsset::class]] );?>