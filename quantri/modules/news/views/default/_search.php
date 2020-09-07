<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model quantri\modules\news\models\NewsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'link') ?>

    <?= $form->field($model, 'images') ?>

    <?= $form->field($model, 'image_category') ?>

    <?php // echo $form->field($model, 'image_detail') ?>

    <?php // echo $form->field($model, 'category_id') ?>

    <?php // echo $form->field($model, 'htmltitle') ?>

    <?php // echo $form->field($model, 'htmlkeyword') ?>

    <?php // echo $form->field($model, 'htmldescriptions') ?>

    <?php // echo $form->field($model, 'short_description') ?>

    <?php // echo $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'hot') ?>

    <?php // echo $form->field($model, 'view') ?>

    <?php // echo $form->field($model, 'related_products') ?>

    <?php // echo $form->field($model, 'related_news') ?>

    <?php // echo $form->field($model, 'sort') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'userCreated') ?>
    <?php // echo $form->field($model, 'userCreated') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
