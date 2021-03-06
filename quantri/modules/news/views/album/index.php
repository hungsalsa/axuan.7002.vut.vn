<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Danh sách Album ảnh';
$this->params['breadcrumbs'][] = $this->title;
$moduleController = '/'.$this->context->module->id.'/'.$this->context->id.'/';
?>
<div class="album-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="btn_save">
        <?= Html::a('Thêm mới', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'name',
            [
               'attribute' => 'name',
               'format' => 'raw',
               'value'=>function ($data) {
                return Html::a(Html::encode($data->name),Url::to(['view','id'=>$data->id],true)) ; //id='.$data->id);
                },
            ],
            // 'slug',
            // 'content:ntext',
            // 'title',
            [
               'attribute' => 'cate_id',
               'value' => 'categories.cateName',
           ],
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
            //'keywords:ntext',
            //'descriptions:ntext',
            //'status',
            //'created_at',
            'updated_at:datetime',
            [
                'attribute'=>'userUpdated',
                'value'=>'userUpdate.username',
            ],
            //'userCreated',
            //'userUpdated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
