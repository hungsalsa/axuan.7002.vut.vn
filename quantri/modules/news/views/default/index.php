<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Danh sách tin tức';
$this->params['breadcrumbs'][] = $this->title;
$moduleController = '/'.$this->context->module->id.'/'.$this->context->id.'/';

    
?>
<div class="news-index">

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
                return Html::a(Html::img($data->images,['style'=>'width:47px']).'   ' . Html::encode($data->name),Url::to(['default/update','id'=>$data->id],true)) ; //id='.$data->id);
                },
            ],

            
            // 'newSlug',
            // 'image_category',
            //'image_detail',
            // [
            //    'attribute' => 'images',
            //    'format' => 'raw',
            //    'value'=>function ($data) {
            //         return Html::img('/'.$data->images,['alt'=>$data->htmltitle,'style'=>'width:46px']);
            //     },
            // ],
            [
                'attribute'=>'category_id',
                'value'=>'categories.cateName',
            ],
            //'htmltitle',
            //'htmlkeyword',
            //'htmldescriptions:ntext',
            //'short_description:ntext',
            //'content:ntext',
            'view',
            
            //'related_products',
            //'related_news',
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
                'attribute' =>'hot',
                'contentOptions' => ['class' => 'text-center','style'=>'width:5%'],
                'format'=>'html',
                'content' => function($model,$key,$index, $column) use ($moduleController){
                    $classbtn = ($model->hot==0)? 'btn-danger':'btn-success';
                    return Html::button(($model->hot==0)?' Không ':' Có ',$options = [
                        'data-id'=>$key,
                        'data-field'=>'hot',
                        'id'=>'hot'.$key,
                        "data-url"=>Yii::$app->getUrlManager()->createUrl([$moduleController.'statuschange']),
                        "class"=>"btn btn-block btn-outline $classbtn Quickactive change",
                    ]);
                },
            ],
            
            [
                'attribute' =>'status',
                'contentOptions' => ['class' => 'text-center','style'=>'width:5%'],
                'format'=>'html',
                'content' => function($model,$key,$index, $column) use ($moduleController) {
                    $classbtn = ($model->status==0)? 'btn-danger':'btn-success';
                    return Html::button(($model->status==0)?' Ẩn ':'Hiện',$options = [
                        'data-id'=>$key,
                        'data-field'=>'status',
                        'id'=>'status'.$key,
                        "data-url"=>Yii::$app->getUrlManager()->createUrl([$moduleController.'statuschange']),
                        "class"=>"btn btn-block btn-outline $classbtn Quickactive change",
                    ]);
                },
            ],
            [
                'attribute' =>'formshow',
                'contentOptions' => ['class' => 'text-center','style'=>'width:5%'],
                'format'=>'html',
                'content' => function($model,$key,$index, $column) use ($moduleController) {
                    $classbtn = ($model->formshow==0)? 'btn-danger':'btn-success';
                    return Html::button(($model->formshow==0)?' Ẩn ':'Hiện',$options = [
                        'data-id'=>$key,
                        'data-field'=>'formshow',
                        'id'=>'formshow'.$key,
                        "data-url"=>Yii::$app->getUrlManager()->createUrl([$moduleController.'statuschange']),
                        "class"=>"btn btn-block btn-outline $classbtn Quickactive change",
                    ]);
                },
            ],
            [
                'attribute' =>'interest',
                'contentOptions' => ['class' => 'text-center','style'=>'width:5%'],
                'format'=>'html',
                'content' => function($model,$key,$index, $column) use ($moduleController) {
                    $classbtn = ($model->interest==0)? 'btn-danger':'btn-success';
                    return Html::button(($model->interest==0)?'Ẩn':'Có',$options = [
                        'data-id'=>$key,
                        'data-field'=>'interest',
                        'id'=>'interest'.$key,
                        "data-url"=>Yii::$app->getUrlManager()->createUrl([$moduleController.'statuschange']),
                        "class"=>"btn btn-block btn-outline $classbtn Quickactive change",
                    ]);
                },
            ],
            //'user_add',
            //'created_at',
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:H:i d-m-Y']
            ],
            [
                'attribute'=>'userUpdated',
                'value'=>'userUpdate.username',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
<?php $this->registerJsFile('@web/js/product/global.js', ['depends' => [\yii\web\JqueryAsset::class]] );
$this->registerJsFile('@web/js/product/news_index.js', ['depends' => [\yii\web\JqueryAsset::class]] );?>