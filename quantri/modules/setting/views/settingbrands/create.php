<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model quantri\modules\setting\models\SettingBrands */

$this->title = 'Thêm mới thương hiệu';
$this->params['breadcrumbs'][] = ['label' => 'Setting Brands', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="setting-brands-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
