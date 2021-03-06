<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use quantri\modules\products\models\Products;
/* @var $this yii\web\View */
 use quantri\modules\news\models\News;

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'News', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="news-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="btn_save">
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'name',
            'newSlug',
            'images',
            // 'image_category',
            // 'image_detail',
            'category_id',
            'htmltitle',
            'htmlkeyword',
            'htmldescriptions:ntext',
            'short_description:ntext',
            'content:html',
            
            [
               'attribute' => 'related_products',
               'format' => 'raw',
               'value'=>function ($data) {
                    if ($data->related_products=='') {
                        return '';
                    } else {
                        try {
                            $related_products= json_decode($data->related_products);
                            $products = Products::findAll(json_decode($data->related_products));
                            $related_products = array_column($products, 'pro_name');
                            return implode(";",$related_products);
                            
                        } catch (Exception $e) {
                            return 'Loi san pham lien quan, '.$e->getMessage().' In Line '.$e->getLine();
                        }
                    }
                },
            ],
            [
               'attribute' => 'related_news',
               'format' => 'raw',
               'value'=>function ($data) {
                    if ($data->related_news=='') {
                        return '';
                    } else {
                        try {
                            $related_news= json_decode($data->related_news);
                            $products = News::findAll(json_decode($data->related_news));
                            $related_news = array_column($products, 'name');
                            return implode(";",$related_news);
                            
                        } catch (Exception $e) {
                            return 'Loi san pham lien quan, '.$e->getMessage().' In Line '.$e->getLine();
                        }
                    }
                },
            ],
            'sort',
            'view',
            [
               'attribute' => 'hot',
               'format' => 'raw',
               'value'=>function ($data) {
                    if ($data->hot==1) {
                        return 'Kích hoạt';
                    } else {
                        return '  Không ';
                        
                    }
                },
            ],
            [
               'attribute' => 'status',
               'format' => 'raw',
               'value'=>function ($data) {
                    if ($data->status==1) {
                        return 'Kích hoạt';
                    } else {
                        return '  Ẩn ';
                    }
                },
            ],
            'created_at:datetime',
            'updated_at:datetime',
            // 'userCreated',
            // 'userUpdated',
        ],
    ]) ?>

</div>
