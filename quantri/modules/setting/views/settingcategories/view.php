<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model quantri\modules\setting\models\SettingCategories */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Setting Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="setting-categories-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
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
            'id',
            'name',
            'parent_id',
            'link_cate',
            'slug_cate',
            'title',
            'description:ntext',
            'order',
            'icon',
            'status',
            'created_at',
            'updated_at',
            'userCreated',
            'userUpdated',
        ],
    ]) ?>

</div>
