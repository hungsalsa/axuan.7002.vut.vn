<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel quantri\modules\products\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Danh sách đơn hàng';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="btn_save">
        <?php Html::a('Create Order', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-bordered table-hover'],
        // 'rowOptions' => function ($model, $key, $index, $grid) {
        //     return [
        //         'style' => "cursor: pointer",
        //         'id' => $model['order_id'], 
        //         'onclick' => 'location.href="'
        //         . Yii::$app->urlManager->createUrl('products/order/view')
        //         . '?id="+(this.id);',
        //     ];
        // },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'order_id',
            [
                'attribute' => 'customer_id',
                'format' => 'raw',
                'value'=>function ($data){
                    return Html::a($data->khachhang->fullname, ['view', 'id' => $data->order_id]);
                },
            ],
            [
                'attribute' => 'email',
                'format' => 'raw',
                'value'=>function ($data){
                    return Html::a($data->khachhang->email, ['view', 'id' => $data->order_id]);
                },
            ],
            [
                'attribute' => 'phone',
                'format' => 'raw',
                'value'=>function ($data){
                    return Html::a($data->khachhang->phone, ['view', 'id' => $data->order_id]);
                },
            ],
            // 'email:email',
            // 'phone',
            [
                'attribute' =>'status',
                'contentOptions' => ['class' => 'text-center','style'=>'width:10%'],
                'format'=>'html',
                'content' => function($model,$key,$index, $column) {
                    $classbtn = ($model->status==0)? 'btn-danger':'btn-success';
                    return Html::button(($model->status==0)?' Chưa xử lý ':'Đã xử lý',$options = [
                        'data-id'=>$key,
                        'data-field'=>'status',
                        'id'=>'status'.$key,
                        "data-url"=>Yii::$app->getUrlManager()->createUrl(['/products/productcategory/statuschange']),
                        "class"=>"btn btn-block btn-outline $classbtn Quickactive change",
                    ]);
                },
            ],
            'updated_at:datetime',
            [
                'attribute' => 'userUpdated',
                'contentOptions' => ['class' => 'text-center'],
                'format' => 'raw',
                'value'=>function ($data){
                    try {
                        return $data->user->username;
                    } catch (Exception $e) {
                        return "Chưa ";
                    }
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'headerOptions' => ['style' => 'color:#337ab7;width: 8%'],
                'contentOptions' => ['class' => 'actionColumn','style' => 'font-size:18px'],
                'template' => '{view} {delete}',
                'visibleButtons' => [
                    'view' => Yii::$app->user->can('products/productcategory/view'),
                    // 'update' => Yii::$app->user->can('products/productcategory/update'),
                    'delete' => Yii::$app->user->can('products/productcategory/delete')
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
</div>