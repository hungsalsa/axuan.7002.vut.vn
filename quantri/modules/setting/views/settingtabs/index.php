<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel quantri\modules\setting\models\SettingTabsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Danh sách Tabs trang chủ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="setting-tabs-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="btn_save">
        <?= Html::a('Thêm mới', ['create'], ['class' => 'btn btn-success btn_luu']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'link_cate',
            'slug',
            'name',
            'status',
            //'created_at',
            //'updated_at',
            //'userCreated',
            //'userUpdated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
