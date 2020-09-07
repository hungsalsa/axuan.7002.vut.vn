<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

$this->title = $model->fullname;
$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="customers-view">

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
            'fullname',
            'phone',
            'email:email',
            'note:ntext',
            [
               'attribute' => 'url',
               'format' => 'html',
               'value'=>function ($data) {
                    if ($data->type == 'news') {

                        return Html::a(Html::img('/'.$data->newslink->images,['width'=>'100px']).$data->newslink->name,Yii::$app->request->gethostInfo().$data->url);
                    } else {
                        return $data->productlink->pro_name;
                    }
                },
            ],
            // 'id_link',
            // 'type',
            // 'url:url',
            'created_at:datetime',
            'updated_at:datetime',
            'userUpdated',
        ],
    ]) ?>

</div>
