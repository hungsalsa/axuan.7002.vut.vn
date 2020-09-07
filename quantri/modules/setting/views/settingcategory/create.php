<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model quantri\modules\setting\models\SettingCategory */

$this->title = 'Thêm mới category';
$this->params['breadcrumbs'][] = ['label' => 'Setting Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="setting-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'seo' => $seo,
        'dataSetCate' => $dataSetCate,
        'dataLinkCat' => $dataLinkCat,
    ]) ?>

</div>
