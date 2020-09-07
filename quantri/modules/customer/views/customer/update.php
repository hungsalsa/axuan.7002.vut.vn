<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model quantri\modules\customer\models\Customers */

$this->title = 'Chỉnh sửa khách hàng : ' . $model->fullname;
$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="customers-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
