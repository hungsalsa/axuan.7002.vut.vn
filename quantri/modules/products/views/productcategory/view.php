<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model quantri\modules\quantri\models\Productcategory */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Productcategories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="productcategory-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Chỉnh sửa', ['update', 'id' => $model->idCate], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('danh sách', ['index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Xóa', ['delete', 'id' => $model->idCate], [
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
            // 'idCate',
            'title',
            'cateName',
            'slug',
            'keyword:ntext',
            'description:ntext',
            'content:ntext',
            'short_introduction:ntext',
            'home_page',
            'image',
            'order',
            'active',
            'product_parent_id',
            'created_at',
            'updated_at',
            'userCreated',
            'userUpdated',
        ],
    ]) ?>

</div>