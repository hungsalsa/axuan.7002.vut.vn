<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model quantri\modules\news\models\Downloads */

$this->title = 'Thêm mới Downloads';
$this->params['breadcrumbs'][] = ['label' => 'Downloads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="downloads-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'data' => $data,
    ]) ?>

</div>
<?php $this->registerJsFile("@web/js/change_slug.js", ['depends' => [yii\web\JqueryAsset::className()]]); ?>