<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model quantri\modules\quantri\models\Categories */

$this->title = 'Thêm danh mục '.$title;
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categories-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'data' => $data,
    ]) ?>

</div>
<?php $this->registerJsFile("@web/js/change_slug.js", ['depends' => [yii\web\JqueryAsset::className()]]); ?>