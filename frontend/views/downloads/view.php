<?php use yii\helpers\Html; ?>

<?= Html::a('PDF', [
    'controller/pdf',
    'id' => $model->id,
], [
    'class' => 'btn btn-primary',
    'target' => '_blank',
]); ?>