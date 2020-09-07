<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
/* @var $this yii\web\View */
/* @var $model quantri\modules\setting\models\SettingTabs */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Setting Tabs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="setting-tabs-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Chỉnh sửa', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Danh sách', ['index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(' Xóa ', ['delete', 'id' => $model->id], [
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
            'id',
            'link_cate',
            'child_cate',
            'slug',
            'name',
            'status',
            'created_at',
            'updated_at',
            'userCreated',
            'userUpdated',
        ],
    ]) ?>

</div>
