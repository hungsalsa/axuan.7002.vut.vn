<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model quantri\modules\products\models\ProductVersions */

$this->title = 'Create Product Versions';
$this->params['breadcrumbs'][] = ['label' => 'Product Versions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-versions-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
