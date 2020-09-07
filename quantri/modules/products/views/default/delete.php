<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model quantri\modules\products\models\Products */

$this->title = 'Sản phẩm : '.$model->pro_name.' vẫn còn đơn hàng. Bạn có muốn xóa sản phẩm này ?';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="products-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="btn_save">
        <?= Html::a('Xóa <i class="glyphicon glyphicon-trash"></i>', ['delete'], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Bạn chắc chắn xóa sản phẩm này?',
                'method' => 'post',
                'params' =>['id' => $model->id, 'delete' => true]
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'pro_name',
            'short_introduction:html',
            'price',
            'price_sales',
            'start_sale',
            'end_sale',
            'views',
            'product_category_id',
        ],
    ]) ?>

</div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="panel panel-default block1">
        <div class="panel-heading">Danh sách đơn hàng</div>
        <div class="panel-wrapper collapse in">
            <div class="panel-body">
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <td>STT</td>
                            <td>fullname</td>
                            <td>email</td>
                            <td>phone</td>
                            <td>address</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  foreach ($customers as $key => $customer): ?>
                            <tr>
                                <td><?= $key+1 ?></td>
                                <td><?= Html::a($customer['fullname'], ['/products/order/view','id'=>$customer['order_id']], ['class' => 'btn btn-outline btn-success']) ?>
                                </td>
                                <td><?= $customer['email'] ?></td>
                                <td><?= $customer['phone'] ?></td>
                                <td><?= $customer['address'] ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <hr> </div>