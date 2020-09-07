<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model quantri\modules\products\models\Products */

$this->title = 'Thêm mới sản phẩm';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'data' => $data,
        // 'image_model' => $image_model,
        'modelsProductThuoctinh' => $modelsProductThuoctinh,
    ]) ?>

</div>
<?php $this->registerJsFile("@web/js/change_slug.js", ['depends' => [yii\web\JqueryAsset::className()]]); ?>