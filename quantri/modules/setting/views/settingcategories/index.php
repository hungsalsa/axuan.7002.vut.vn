<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use quantri\modules\setting\models\SettingCategories;
use kartik\select2\Select2;
$menu = new SettingCategories();
$dataMenu = [0 =>' Root '];
$dataMenu += $menu->getParentSetCategory();
// dbg($dataMenu);
// $dataMenu = $data = array_merge([0=>' Root '],$menu->getParentSetCategory());
$this->title = 'Side bar Cate Danh mục';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="setting-categories-index">

    <h1><?= Html::encode($this->title) ?><button class="right-side-toggle waves-effect waves-light btn-info btn-circle pull-right m-l-20"><i class="ti-settings text-white"></i></button></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="btn_save">
        <?= Html::a('Thêm mới', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => "Từ {begin} đến {end} trong tổng {totalCount} Sidebar",
        'tableOptions' => ['class' => 'table table-bordered table-hover'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            
            [
                'attribute' =>'name',
                'contentOptions' => ['class' => 'text-center'],
                'format'=>'html',
                'content' => function($model,$key,$index, $column) {
                    $html = "<div class=\"col-md-12 updateProduct$key proUpdate\">".
                    Html::textInput('name', $model->name, ['class'=>'form-control col-md-4','id'=>'menuName'.$key]).
                    Html::button('Save',$options = ['class'=>'btn btn-info btn-outline col-md-5 saveMenuName',"data-url"=>Yii::$app->getUrlManager()->createUrl(['/setting/settingcategories/quickchange']),'data-id'=>$key,'data-field'=>'name']).
                    Html::button('Cancel',$options = ['class'=>'btn btn-default btn-outline col-md-6 Cancel','style'=>'margin:2px']).
                    
                    "</div>";
                    return Html::button($model->name,$options = [
                        'data-field'=>'name',
                        'data-id'=>$key,
                        'id'=>'buttonname'.$key,
                        'class'=>'btn btn-block btn-outline btnName Quickchange change',
                    ]).$html;
                },
            ],
            [
                'attribute' =>'parent_id',
                // 'headerOptions' => ['width' => '20%'],
                'format'=>'html',
                'content' => function($model,$key,$index, $column) use($dataMenu){
                    // unset($dataMenu[$model->id]);
                    // pr($data);
                    // dbg($dataMenu);
                    $html = "<div class=\"updateProduct$key proUpdate\">".
                    Select2::widget([
                        'name' => 'parent_id',
                        'value' => $model->parent_id,
                        'data' => $dataMenu,
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                        'options' => [
                             // 'allowClear'=> true,
                            'id'=>'parent_id'.$key,
                            'class'=>'form-control',
                            'placeholder' => 'Select provinces ...',
                        ],
                    ]).
                    Html::button('Save',$options = ['class'=>'btn btn-info btn-outline col-md-5 m-3 saveMenuName','style'=>'margin:2px',"data-url"=>Yii::$app->getUrlManager()->createUrl(['/setting/settingcategories/quickchange']),'data-id'=>$key,'data-field'=>'parent_id']).
                    Html::button('Cancel',$options = ['class'=>'btn btn-default btn-outline col-md-6 m-3 Cancel','style'=>'margin:2px']).
                    "</div>";

                    return Html::tag('span',($model->parent_id == 0) ? ' Root ': $dataMenu[$model->parent_id],$options = [
                        'data-id'=>$key,
                        'data-field'=>'parent_id',
                        'id'=>'menuName'.$key,
                        'class'=>'text-info btn btn-outline btn-info Quickchange change text-primary',
                    ]).$html;
                },
            ],
            [
               'attribute' => 'link_cate',
               'format' => 'raw',
               'value'=>function ($data) {
                return Html::a(Html::encode($data->category->cateName),Yii::$app->homeUrl.'setting/settingcategories/update?id='.$data->id);
                },
            ],
            // 'slug_cate',
            //'title',
            //'description:ntext',
            //'order',
            [
                'attribute' =>'order',
                'contentOptions' => ['class' => 'text-center','style' => 'width:6%'],
                'format'=>'html',
                'content' => function($model,$key,$index, $column) {
                    $html = "<div class=\"updateProduct$key proUpdate\">".
                    Html::textInput('order', $model->order, ['max' => 998,'class'=>'form-control col-md-4','id'=>'order'.$key]).
                    Html::button('Save',$options = ['class'=>'btn btn-info btn-outline col-md-5 saveOrder',"data-url"=>Yii::$app->getUrlManager()->createUrl(['/setting/settingcategories/quickchange']),'data-id'=>$key]).
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
                    return Html::button(($model->status==0)?' Ẩn ':'Hiện',$options = [
                        'data-id'=>$key,
                        'id'=>'status'.$key,
                        "data-url"=>Yii::$app->getUrlManager()->createUrl(['/setting/settingcategories/statuschange']),
                        "class"=>"btn btn-block btn-outline $classbtn Quickactive change",
                    ]);
                },
            ],
            [
                'attribute'=>'created_at',
                'contentOptions' => ['class' => 'text-center','style' => 'width:10%'],
                'format' => ['date', 'php:H:i d-m-Y']
            ],[
                'attribute'=>'updated_at',
                'contentOptions' => ['class' => 'text-center','style' => 'width:10%'],
                'format' => ['date', 'php:H:i d-m-Y']
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'headerOptions' => ['style' => 'color:#337ab7;width: 8%','class'=>'text-center'],
                'contentOptions' => ['class' => 'actionColumn text-center','style' => 'font-size:18px'],
                'template' => '{view}  {update}  {delete}',
                'visibleButtons' => [
                    'view' => Yii::$app->user->can('setting/settingcategories/view'),
                    'update' => Yii::$app->user->can('setting/settingcategories/update'),
                    'delete' => Yii::$app->user->can('setting/settingcategories/delete')
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
<?php 
$this->registerJsFile('@web/js/product/global.js', ['depends' => [\yii\web\JqueryAsset::class]] );
$this->registerJsFile('@web/js/product/menu_index.js', ['depends' => [\yii\web\JqueryAsset::class]] );?>