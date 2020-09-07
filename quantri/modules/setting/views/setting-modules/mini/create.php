<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model quantri\modules\setting\models\SettingModules */

$this->title = 'Thêm mới Module';
$this->params['breadcrumbs'][] = ['label' => 'Setting Modules', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="setting-modules-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'data' => $data,
    ]) ?>

</div>
