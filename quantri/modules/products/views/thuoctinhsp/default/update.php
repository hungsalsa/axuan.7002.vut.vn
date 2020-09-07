<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model quantri\modules\products\models\Products */

$this->title = 'Chỉnh sửa sản phẩm: ' . $model->pro_name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="products-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'data' => $data,
        'listImages' => $listImages,
        'productVersions' => $productVersions,
        'modelsProductThuoctinh' => $modelsProductThuoctinh,
    ]) ?>

</div>