<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model quantri\modules\news\models\Album */

$this->title = 'Thêm mới Album';
$this->params['breadcrumbs'][] = ['label' => 'Albums', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="album-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        // 'modelsImages' => $modelsImages,
        'data' => $data,
    ]) ?>

</div>
<?php $this->registerJsFile("@web/js/change_slug.js", ['depends' => [yii\web\JqueryAsset::className()]]); ?>