<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel quantri\modules\setting\models\SettingBrandsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Danh sách thương hiệu';
$this->params['breadcrumbs'][] = $this->title;

// dbg(Url::home('http'));
?>
<div class="setting-brands-index">

    <h1><?= Html::encode($this->title) ?></h1>
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
            [
               'attribute' => 'name',
               'format' => 'raw',
               'value'=>function ($data) {
                    return Html::a(Html::encode($data->name),Url::toRoute(['settingbrands/update', 'id' => $data->id]));
                },
            ],
            [
               'attribute' => 'image',
               'format' => 'raw',
               'value'=>function ($data) {
                return Html::img(Yii::$app->request->hostInfo.'/'.$data->image, ['alt' => 'My logo']);
                },
            ],
            'alt',
            //'link',
            'order',
            'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
    <?php Pjax::end(); ?>
</div>
