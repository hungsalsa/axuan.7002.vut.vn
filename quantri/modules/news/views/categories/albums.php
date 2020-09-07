<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel quantri\modules\quantri\models\CategoriesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Danh mục albums ';
$this->params['breadcrumbs'][] = $this->title;
$moduleController = '/'.$this->context->module->id.'/'.$this->context->id.'/';
?>

<div class="categories-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="btn_save">
        <?= Html::a('Thêm mới', ['create','parent_id'=>8,'title'=>'Albums'], ['class' => 'btn btn-success btn_luu']) ?>

    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'cateName',
            [
               'attribute' => 'cateName',
               'format' => 'raw',
               'value'=>function ($data) {
                    return Html::a(Html::encode($data->cateName),Url::toRoute(['categories/update', 'id' => $data->id,'parent_id'=>8,'title'=>'Albums']));
                },
            ],
            [
               'attribute' => 'parent_id',
               // 'value'=>'parentCate.cateName',
               'value'=>function ($data) {
                    if ($data->parent_id == 0) {
                        return 'ROOT';
                    } else {
                        return isset($data->parentCate->cateName)? $data->parentCate->cateName : null;

                    }
                },
            ],
            // 'parent_id',
            // 'slug',
            //'images',
            [
                'attribute' =>'sort',
                'contentOptions' => ['class' => 'text-center','style' => 'width:6%'],
                'format'=>'html',
                'content' => function($model,$key,$index, $column) use ($moduleController) {

                    $html = "<div class=\"updateProduct$key proUpdate\">".
                    Html::textInput('sort', $model->sort, ['max' => 998,'class'=>'form-control col-md-4','id'=>'sort'.$key]).
                    Html::button('Save',$options = ['class'=>'btn btn-info btn-outline col-md-5 savecateName',"data-url"=>Yii::$app->getUrlManager()->createUrl([$moduleController.'quickchange']),'data-id'=>$key,'data-field'=>'sort']).
                    Html::button('Cancel',$options = ['class'=>'btn btn-default btn-outline col-md-6 Cancel','style'=>'margin:2px']).
                    
                    "</div>";
                    return Html::button($model->sort,$options = [
                        // 'data-field'=>'sort',
                        'data-id'=>$key,
                        'id'=>'buttonOrder'.$key,
                        'class'=>'btn btn-block btn-outline btn-info Quickchange change',
                    ]).$html;
                },
            ],
            [
                'attribute' =>'status',
                'contentOptions' => ['class' => 'text-center','style'=>'width:5%'],
                'format'=>'html',
                'content' => function($model,$key,$index, $column) use ($moduleController) {
                    $classbtn = ($model->status==0)? 'btn-danger':'btn-success';
                    return Html::button(($model->status==0)?' Ẩn ':'Kích hoạt',$options = [
                        'data-id'=>$key,
                        'data-field'=>'status',
                        'id'=>'status'.$key,
                        "data-url"=>Yii::$app->getUrlManager()->createUrl([$moduleController.'statuschange']),
                        "class"=>"btn btn-block btn-outline $classbtn Quickactive change",
                    ]);
                },
            ],
            //'title',
            //'keyword',
            //'descriptions:ntext',
             [
                'class' => 'yii\grid\DataColumn',
                'attribute' => 'created_at',
                'content'=>function($data){
                    return date('d/m/Y - H:i:s', $data->created_at);
                },
                'headerOptions' => ['class' => 'text-center'],
                'contentOptions' => ['style' => '', 'class' => 'text-center'],
            ],
            // [
            //     'class' => 'yii\grid\DataColumn',
            //     'attribute' => 'updated_at',
            //     'content'=>function($data){
            //         return date('d/m/Y - H:i:s', $data->created_at);
            //     },
            //     'headerOptions' => ['class' => 'text-center'],
            //     'contentOptions' => ['style' => '', 'class' => 'text-center'],
            // ],
            // [
            //   'attribute' => 'updated_at',
            //   'formatter' => [
            //         'class' => 'yii\i18n\Formatter',
            //         'dateFormat' => 'php:d-M-Y',
            //         'datetimeFormat' => 'php:d-M-Y H:i:s',
            //         'timeFormat' => 'php:H:i:s',
            //     ],
            //   'value'=>function($data){
            //             return  date('d/m/Y - H:i:s', $data->created_at);
            //         },
                
            // ],
            //'created_at',
            //'updated_at',
            // 'userUpdated',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Action',
                'headerOptions' => ['class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center'],
                'template' => '{view}  {update}  {delete}',
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['update', 'id'=>$model->id,'parent_id'=>8,'title'=>'Albums'], ['title' => 'DS ảnh', 'data' => ['pjax' => 0]] );
                    },
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
<?php $this->registerJsFile('@web/js/product/global.js', ['depends' => [\yii\web\JqueryAsset::class]] );
$this->registerJsFile('@web/js/product/news_index.js', ['depends' => [\yii\web\JqueryAsset::class]] );?>