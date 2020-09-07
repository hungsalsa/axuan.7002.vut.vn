<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model quantri\modules\products\models\Products */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="products-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="btn_save">
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Bạn chắc chắn xóa sản phẩm này?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
             'id',
            'code',
            'pro_name',
            'inventory',
            'amount',
            'order_out_stock',
            'highlights',
            'order',
            'supplier_id',
            'title',
            'slug',
            'keywords:ntext',
            'descriptions:ntext',
            'short_introduction:ntext',
            'content:ntext',
            'price',
            'price_sales',
            'vat',
            'start_sale',
            'end_sale',
            'product_type_id',
            'warranty_period',
            'models_id',
            'views',
            'image',
            'images_list',
            'tags',
            'product_category_id',
            'related_articles:ntext',
            'related_products:ntext',
            'status',
            'time_status:datetime',
            'created_at',
            'updated_at',
            'userCreated',
            'userUpdated',
        ],
    ]) ?>

</div>