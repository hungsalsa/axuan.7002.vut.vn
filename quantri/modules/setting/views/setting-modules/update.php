<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model quantri\modules\setting\models\SettingModules */

$this->title = 'Chỉnh sửa Module : '.$model->name;
$this->params['breadcrumbs'][] = ['label' => 'Setting Modules', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="setting-modules-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'data' => $data,
    ]) ?>

</div>
