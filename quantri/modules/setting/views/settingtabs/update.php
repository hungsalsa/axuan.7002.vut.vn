<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model quantri\modules\setting\models\SettingTabs */

$this->title = 'Chỉnh sửa Tabs: '.$model->name;
$this->params['breadcrumbs'][] = ['label' => 'Setting Tabs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="setting-tabs-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'dataLinkCat' => $dataLinkCat,
    ]) ?>

</div>
