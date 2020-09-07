<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel quantri\modules\setting\models\SettingDefaultSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Setting Defaults';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="setting-default-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'logo',
            'title',
            'description:ntext',
            'keyword',
            //'ad',
            //'footer:ntext',
            //'google_analytics',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
    <?php Pjax::end(); ?>
</div>
