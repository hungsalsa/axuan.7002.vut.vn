<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel quantri\modules\setting\models\BannerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Quản lý Banner';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="banner-index">
        <h4 class="text-center"><?= Html::encode($this->title) ?></h4>
    

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="btn_save">
        <?= Html::a('Thêm mới', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'name',
            [
                'format' => 'html',
               'attribute'=>'image',
               // 'contentOptions'=>['style'=>'width:15%'],
               'value' => function($data) {
                // pr($data->image);
                return Html::a(Html::img(Yii::$app->request->hostinfo.$data->image,['height'=>'100']), ['update', 'id' => $data->id], ['class' => 'btn btn-outline btn-primary']);

                // return Html::a(Html::img(Yii::$app->request->hostinfo.'/'.$data->image,['height'=>'100']),Yii::$app->homeUrl.'setting/banner/update?id='.$data->id);
                },
            ],
            'url:url',
            // 'alt',
            [
                'attribute' =>'order',
                'contentOptions' => ['class' => 'text-center','style' => 'width:6%'],
                'format'=>'html',
                'content' => function($model,$key,$index, $column) {
                    $html = "<div class=\"updateProduct$key proUpdate\">".
                    Html::textInput('order', $model->order, ['max' => 998,'class'=>'form-control col-md-4','id'=>'order'.$key]).
                    Html::button('Save',$options = ['class'=>'btn btn-info btn-outline col-md-5 saveOrder',"data-url"=>Yii::$app->getUrlManager()->createUrl(['/setting/banner/quickchange']),'data-id'=>$key]).
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
                        "data-url"=>Yii::$app->getUrlManager()->createUrl(['/setting/banner/statuschange']),
                        "class"=>"btn btn-block btn-outline $classbtn Quickactive change",
                    ]);
                },
            ],
            // 'order',
            // 'content:html',
            // 'status',
            //'created_at',
            //'updated_at',
            //'user_id',

            ['contentOptions'=>['style'=>'width:5%'],'class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
    <?php Pjax::end(); ?>
</div>
<?php $this->registerJsFile('@web/js/product/global.js', ['depends' => [\yii\web\JqueryAsset::class]] );
$this->registerJsFile('@web/js/product/menu_index.js', ['depends' => [\yii\web\JqueryAsset::class]] );?>