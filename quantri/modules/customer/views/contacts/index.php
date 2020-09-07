<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel quantri\modules\customer\models\ContactsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Hội viên mới';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contacts-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!-- <p>
        <?= Html::a('Create Contacts', ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => "Từ {begin} đến {end} trong tổng {totalCount} ".$this->title,
            'tableOptions' => ['class' => 'table table-bordered table-hover'],
            'rowOptions' => function ($model, $key, $index, $grid) {
                 return [
                    'style' => "cursor: pointer",
                    'id' => $model['id'], 
                    'onclick' => 'location.href="'
                    . Yii::$app->urlManager->createUrl('hoi-vien/chi-tiet-')
                    . '"+(this.id);',
                ];
            },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'company_name',
            'address',
            'tax_code',
            'manager',
            //'gender',
            //'birth_day',
            //'phone',
            //'email:email',
            //'business',
            //'date_bussiness',
            //'website',
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
            'created_at:datetime',
            //'updated_at',
            //'userCreated',
            [
                'attribute' =>'userUpdated',
                'value' => function($data) {
                    
                    return isset($data->user->username)? $data->user->username : 'Chưa';;
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
