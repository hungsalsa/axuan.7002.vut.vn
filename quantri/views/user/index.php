<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Danh sách User';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="btn_save">
        <?= Html::a('Thêm mới User', ['signup'], ['class' => 'btn btn-success btn_luu']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'username',
            'fullname',
            // 'auth_key',
            // 'password_hash',
            //'password_reset_token',
            'email:email',
            //'image',
            //'phone',
            //'status',
            'created_at:datetime',
            //'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'headerOptions' => ['style' => 'color:#337ab7;width: 9%'],
                'contentOptions' => ['class' => 'actionColumn text-center','style' => 'font-size:18px'],
                'template' => '{update}  {delete}  {resetpassword}',
                'visibleButtons' => [
                    'update' => Yii::$app->user->can('user/update'),
                    'delete' => Yii::$app->user->can('user/delete')
                ],

                'buttons'  => [
                    'resetpassword'   => function ($url, $model) {//dbg(Yii::$app->user->id);
                        $url = Url::to(['user/resetpassword', 'id' => $model->id]);
                        return ($model->id==Yii::$app->user->id)?'': Html::a('<span class="fa fa-key"></span>', $url, ['title' => 'Reset Password','style'=>'margin-left:3px;font-size:23px;font-weight:bold;']);
                    },
                ]

            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
