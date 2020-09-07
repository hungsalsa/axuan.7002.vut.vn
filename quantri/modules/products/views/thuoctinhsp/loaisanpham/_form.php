<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model quantri\modules\products\models\ProductsType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'typeName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
