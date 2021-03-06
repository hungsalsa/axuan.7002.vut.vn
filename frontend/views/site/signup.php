<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'income';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1 class="text-white"><?= Html::encode($this->title) ?></h1>


        <div class="col-lg-10">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label(false) ?>

                <?= $form->field($model, 'password')->passwordInput()->label(false) ?>

                <?php // $form->field($model, 'rememberMe',['options'=>['class'=>'checkbox checkbox-success']])->checkbox(['template' => "{input}{label}"]) ?>

                <div class="form-group">
                    <?= Html::submitButton(' &emsp; ', ['class' => 'btn btn-block btn-default bg-light', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
</div>
