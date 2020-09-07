<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model quantri\modules\setting\models\SettingCategory */

$this->title = 'Update Setting Category: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Setting Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="setting-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'seo' => $seo,
        'dataSetCate' => $dataSetCate,
        'dataLinkCat' => $dataLinkCat,
    ]) ?>

</div>
