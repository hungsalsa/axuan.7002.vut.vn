<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel quantri\modules\customer\models\CustomersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Danh sách khách liên hệ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customers-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="btn_save">
        <?php Html::a('Create Customers', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'summary' => "Từ {begin} đến {end} trong tổng {totalCount} khách hàng",
            'tableOptions' => ['class' => 'table table-bordered table-hover'],
            'rowOptions' => function ($model, $key, $index, $grid) {
                 return [
                    'style' => "cursor: pointer",
                    'id' => $model['id'], 
                    'onclick' => 'location.href="'
                    . Yii::$app->urlManager->createUrl('khach-hang/chi-tiet-')
                    . '"+(this.id);',
                ];
            },
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                // 'id',
                'fullname',
                'phone',
                'email:email',
                'type',
                [
                   'attribute' => 'url',
                   'format' => 'html',
                   'value'=>function ($data) {
                    switch ($data->type) {
                        case 'news':
                        {
                            try {
                                $return =  Html::a(Html::img($data->newslink->images,['height'=>'34']).$data->newslink->name,Yii::$app->request->gethostInfo().$data->url);
                                return $return;
                                if(!$return){
                                    throw new Exception('Invalid URL: '.$return);
                                }
                            } catch (Exception $e) {
                                $whitelist = array('127.0.0.1', "::1");
                                if(in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
                                   pr($e->__toString());
                               }else {
                                // echo $e->getMessage();
                                echo "<br>Url bị lỗi";
                                }
                            }
                            break;
                        }
                        case 'product':
                        {
                            try {
                                $return =  Html::a(Html::img($data->newslink->images,['height'=>'34']).$data->newslink->name,Yii::$app->request->gethostInfo().$data->url);
                                if(!$return){
                                    throw new Exception('Invalid URL: '.$return);
                                }
                                return $return;
                            } catch (Exception $e) {
                                $whitelist = array('127.0.0.1', "::1");
                                if(in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
                                   pr($e->__toString());
                               }else {
                                    // echo $e->getMessage();
                                    echo "<br>Url bị lỗi";
                                }
                            }
                            break;
                        }
                        
                        default:
                        return $data->type;
                        break;
                    }
                    
                    },
                ],
                // 'note:ntext',
                //'id_link',
                
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
                //'url:url',
                'created_at:datetime',
                //'updated_at',
                //'userUpdated',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
    <?php Pjax::end(); ?>
</div>
