<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model quantri\modules\quantri\models\ProductcategorySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="productcategory-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'idCate') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'cateName') ?>

    <?= $form->field($model, 'slug') ?>

    <?= $form->field($model, 'keyword') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'short_introduction') ?>

    <?php // echo $form->field($model, 'home_page') ?>

    <?php // echo $form->field($model, 'image') ?>

    <?php // echo $form->field($model, 'order') ?>

    <?php // echo $form->field($model, 'active') ?>
    
    <?php // echo $form->field($model, 'product_type_id') ?>

    <?php // echo $form->field($model, 'product_parent_id') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
