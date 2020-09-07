<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model quantri\modules\setting\models\SettingDefault */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Setting Defaults', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="setting-default-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="btn_save">
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php if ($model->id != 1): ?>
            
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?php endif ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            // 'logo:image',
            [
               'attribute' => 'logo',
               'format' => 'html',
               // 'contentOptions' => ['style' => 'height:100px'],
               'value'=>function ($data) {
                    return Html::img($data->logo,['style' => 'height:100px']);
                },
            ],
            // 'layout_frontent',
            // 'layout_backend',
            'title',
            'description:ntext',
            'keyword',
            'ad',
            'footer_left:html',
            'footer_right:html',
            'tophead',
            'google_analytics',
        ],
    ]) ?>

</div>