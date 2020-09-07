<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model quantri\modules\setting\models\SettingCategories */

$this->title = 'Create Setting Categories';
$this->params['breadcrumbs'][] = ['label' => 'Setting Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="setting-categories-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'dataSetCate' => $dataSetCate,
        'dataLinkCat' => $dataLinkCat,
    ]) ?>

</div>
