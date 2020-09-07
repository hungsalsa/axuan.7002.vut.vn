<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model quantri\modules\products\models\ProductVersions */

$this->title = 'Update Product Versions: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Product Versions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-versions-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
