<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model quantri\modules\quantri\models\Productcategory */

$this->title = 'Chỉnh sửa : '.$model->cateName;
$this->params['breadcrumbs'][] = ['label' => 'Productcategories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->idCate]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="productcategory-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        // 'seo' => $seo,
        'dataCat' => $dataCat,
    ]) ?>

</div>
