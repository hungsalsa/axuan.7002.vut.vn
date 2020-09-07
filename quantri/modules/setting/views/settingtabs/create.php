<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model quantri\modules\setting\models\SettingTabs */

$this->title = 'Thêm mới Tabs trang chủ';
$this->params['breadcrumbs'][] = ['label' => 'Setting Tabs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="setting-tabs-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'dataLinkCat' => $dataLinkCat,
    ]) ?>

</div>
