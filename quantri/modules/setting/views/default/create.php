<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model quantri\modules\setting\models\SettingDefault */

$this->title = 'Create Setting Default';
$this->params['breadcrumbs'][] = ['label' => 'Setting Defaults', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="setting-default-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<?php $this->registerJsFile("@web/js/change_slug.js", ['depends' => [yii\web\JqueryAsset::className()]]); ?>