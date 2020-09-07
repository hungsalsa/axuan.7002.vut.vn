<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model quantri\modules\setting\models\Menus */

$this->title = 'Thêm mới menu';
$this->params['breadcrumbs'][] = ['label' => 'Menuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menus-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'dataMenus' => $dataMenus,
        'menuType' => $menuType,
        'dataLinkCat' => $dataLinkCat,
    ]) ?>

</div>
<?php $this->registerJsFile("@web/js/change_slug.js", ['depends' => [yii\web\JqueryAsset::className()]]); ?>