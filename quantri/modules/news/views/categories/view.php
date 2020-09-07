<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model quantri\modules\quantri\models\Categories */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categories-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item1?',
                'method' => 'post',
            ],
        ]) ?>
        <?php // Html::a('Danh sách', ['index'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'cateName',
            'groupId',
            'parent_id',
            'slug',
            'images',
            'sort',
            'title',
            'keyword',
            'descriptions:ntext',
            // 'status',
             [
                'attribute' => 'status',
                'value'=>function($data){
                    if($data->status==1){
                        return "Kích hoạt";
                    }else{
                        return "Không kích hoạt";
                    }
                },
                // 'headerOptions' => ['class' => 'text-center'],
                'label' => 'Trạng thái',
            ],
            [
                'class'=>'yii\grid\DataColumn',
                'attribute'=>'created_at',
                'formatter'=>[
                    'language' => 'vi',
                    'defaultTimeZone'=>'Asia/Ho_Chi_Minh',
                    'timeZone'=>'Asia/Ho_Chi_Minh',
                    'dateFormat'=>'php:d-m-Y',
                    'datetimeFormat'=>'php:d-M-Y H:i:s'
                ],
                'value'=>function($data){
                    return date('d/m/Y - H:i:s',$data->created_at);
                },
            ],
            [
                'class'=>'yii\grid\DataColumn',
                'attribute'=>'updated_at',
                'formatter'=>[
                    'defaultTimeZone'=>'Asia/Ho_Chi_Minh',
                    'timeZone'=>'Asia/Ho_Chi_Minh',
                    'dateFormat'=>'php:d-m-Y',
                    'datetimeFormat'=>'php:l d-M-Y H:i:s'
                ],
                'value'=>function($data){
                    return date('l d/m/Y - H:i:s',$data->updated_at);
                },
            ],
            // 'created_at',
            // 'updated_at',
            // 'userCreated',
            [
                'attribute'=>'userUpdated',
                'value'=>$model->userUpdate->username,
            ],
        ],
    ]) ?>

</div>