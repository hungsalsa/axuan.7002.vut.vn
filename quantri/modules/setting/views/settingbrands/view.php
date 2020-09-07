<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model quantri\modules\setting\models\SettingBrands */

$this->title = 'Chi tiết thương hiệu : '. $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Setting Brands', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="setting-brands-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="btn_save">
        <?= Html::a('Danh sách', ['index'], ['class' => 'btn btn-info']) ?>
        <?= Html::a('Thêm mới', ['create'], ['class' => 'btn btn-success btn-outline']) ?>
        <?= Html::a('Chỉnh sửa', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Xóa', ['delete', 'id' => $model->id], [
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
            'name',
            'image',
            'alt',
            'description:ntext',
            'link',
            'order',
            'status',
        ],
    ]) ?>

</div>
