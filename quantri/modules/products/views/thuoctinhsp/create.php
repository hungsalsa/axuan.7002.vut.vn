<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model quantri\modules\products\models\ProductProperties */

$this->title = 'Thêm thuộc tính';
$this->params['breadcrumbs'][] = ['label' => 'Product Properties', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-properties-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>