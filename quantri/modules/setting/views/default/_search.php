<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model quantri\modules\setting\models\SettingDefaultSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="setting-default-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'logo') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'keyword') ?>

    <?php // echo $form->field($model, 'ad') ?>

    <?php // echo $form->field($model, 'footer') ?>

    <?php // echo $form->field($model, 'tophead') ?>

    <?php // echo $form->field($model, 'google_analytics') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
