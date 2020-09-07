<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $model quantri\modules\news\models\Album */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Albums', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$moduleController = '/'.$this->context->module->id.'/'.$this->context->id.'/';
?>
<div class="album-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="btn_save">
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>

        
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'name',
            'slug',
            'content:ntext',
            'title',
            'sort',
            'keywords:ntext',
            'descriptions:ntext',
            [
                'attribute' => 'status',
                'value'=>function($data){
                    if($data->status==1){
                        return "Kích hoạt";
                    }else{
                        return "Ẩn";
                    }
                },
                // 'headerOptions' => ['class' => 'text-center'],
                'label' => 'Trạng thái',
                            // 'filter'=>[1=>' Kích hoạt',0=>'Ẩn'],
            ],
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:H:i d-m-Y']
            ],
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:H:i d-m-Y']
            ],
            // 'userCreated',
            // 'userUpdated',
        ],
    ]) ?>

    <div class="panel panel-primary block1">
        <div class="panel-heading">Danh sách ảnh <?= Html::a('Thêm ảnh', ['/news/album-images/create','album_id'=>$model->id,'name'=>$model->name], ['class' => 'btn btn-success pull-right']) ?></div>
        <div class="panel-wrapper collapse in">
            <div class="panel-body">
                <?php if ($dataProvider->getTotalCount() > 0 ): ?>
                
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        // 'id',
                        // 'album_id',
                        // 'image',
                        [
                            'attribute' => 'image',
                            'contentOptions' => ['class' => 'ImageList'],
                            'format' => 'image',
                        ],
                        'title',
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
                        // 'descriptions:ntext',
                        [
                            'attribute' => 'status',
                            'value'=>function($data){
                                if($data->status==1){
                                    return "Kích hoạt";
                                }else{
                                    return "Ẩn";
                                }
                            },
                            'headerOptions' => ['class' => 'text-center'],
                            'label' => 'Trạng thái',
                            // 'filter'=>[1=>' Kích hoạt',0=>'Ẩn'],
                        ],

                        // ['class' => 'yii\grid\ActionColumn'],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'header' => 'Actions',
                            'headerOptions' => ['style' => 'color:#337ab7;width: 16%','class'=>'text-center'],
                            'contentOptions' => ['class' => 'text-center actionColumn','style' => 'font-size:18px'],
                            'template' => '{view}{update}{delete}',
                            'visibleButtons' => [
                                // 'view' => Yii::$app->user->can('quantri/product/view'),
                                // 'update' => Yii::$app->user->can('quantri/product/update'),
                                // 'delete' => Yii::$app->user->can('quantri/product/delete')
                            ],
                            'buttons' => [
                                'update' => function ($url,$model) {
                                    return Html::a(
                                        '<span class="ti-pencil-alt"></span>',['/news/album-images/update','id'=>$model->id,'album_id'=>$model->album_id]
                                        );
                                },
                                'delete' => function ($url,$model,$key) {
                                    return Html::a('<span class="icon-trash"></span>', ['/news/album-images/delete', 'id' => $model->id,'album_id'=>$model->album_id], [
                                        // 'class' => 'btn btn-danger',
                                        'data' => [
                                            'confirm' => 'Are you sure you want to delete this item?',
                                            'method' => 'post',
                                        ],
                                    ]);
                                    /*return Html::a(
                                        '<span class="icon-trash"></span>' ,
                                        ['/news/album-images/delete'],
                                        [
                                            'data' => [
                                                'method' => 'post',
                                                'params' => ['id'=>$model->id,'album_id'=>$model->album_id], 
                                            ],
                                        ]
                                    );*/
                                },
                            ],
                        ],
                    ],
                ]); ?>

                <?php else: ?>
                    <div class="panel-title">Chưa có ảnh nào</div>
                <?php endif ?>
            </div>
        </div>
    </div>

    

</div>

<style>
    .ImageList img{
        height: 72px;
        width: 82px;
    }
</style>