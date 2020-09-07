<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel quantri\models\TagsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tags';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tags-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [
                'attribute'=>'type',
                'value'=>function ($data)
                {
                    if ($data->type=='product') {
                        return 'Sản phẩm';
                    } else {
                        return 'Tin tức';
                    }
                }
            ],
            [
                'attribute'=>'link',
                'value'=>function ($data)
                {
                    if ($data->type=='product') {
                        return '/tag/'.$data->slugTag.'.html';
                        // return $data->product->productCategory->slug;
                    } else {
                        return '/tag-news/'.$data->slugTag.'.html';
                    }
                },
                'label'=>'Liên kết'
            ],
            'value',
            // 'name',
            // 'slugTag',
            // 'link',

        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
