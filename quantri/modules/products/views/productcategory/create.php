<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model quantri\modules\quantri\models\Productcategory */

$this->title = 'Thêm mới danh mục sản phẩm';
$this->params['breadcrumbs'][] = ['label' => 'Productcategories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="productcategory-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'dataCat' => $dataCat,
    ]) ?>

</div>
<?php $this->registerJsFile("@web/js/change_slug.js", ['depends' => [yii\web\JqueryAsset::className()]]); ?>