<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model quantri\modules\news\models\AlbumImages */

$this->title = ($name =='')? 'Thêm mới ảnh Album':'Thêm mới ảnh Album: '.$name;
$this->params['breadcrumbs'][] = ['label' => 'Album Images', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="album-images-create">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'album_id' => $album_id,
        // 'name' => $name,
    ]) ?>

</div>