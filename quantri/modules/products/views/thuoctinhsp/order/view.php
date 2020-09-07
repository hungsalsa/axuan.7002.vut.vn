<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
// use yii\web\NotFoundHttpException;
use yii\base\ErrorException;
/* @var $this yii\web\View */
/* @var $model quantri\modules\products\models\Order */

$this->title = $model->fullname;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="order-view">


    <p class="btn_save">
        <?= Html::a('Update', ['update', 'id' => $model->order_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->order_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading"><h2>Thông tin đơn hàng : <?= $model->fullname ?></h2></div>
                <div class="panel-body">
                    <table class="table table-hover">
                    <!-- <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                        </tr>
                    </thead> -->
                    <tbody>
                        <tr>
                            <td>Tên đầy đủ: <?= $model->fullname ?></td>
                            <td>Số điện thoại : <?= $model->phone ?></td>
                            <td>Địa chỉ : <?= $model->address ?></td>
                            <td>Email : <?= $model->email ?></td>
                        </tr>
                        <tr>
                            <td><?= $model->getAttributeLabel('created_at').' : '.Yii::$app->formatter->asDateTime($model->created_at, "php: H:i:s d-m-Y"); ?></td>
                            <td><?= $model->getAttributeLabel('updated_at').' : '.Yii::$app->formatter->asDateTime($model->updated_at, "php: H:i:s d-m-Y"); ?></td>
                            <td><b><?= $model->getAttributeLabel('userUpdated') ?>  : <?= isset($model->user->username)? $model->user->username : 'Chưa'; ?></b></td>
                            <td>Tình trạng đơn : <button id="orderStatus" onclick="changeStatusOrder(<?= $model->order_id ?>)" class="btn btn-outline btn-rounded btn-<?= ($model->status == 0) ?'danger':'info'?>" style="width: 30%"><?= ($model->status == 0) ? 'Chưa nhận đơn':' Đã nhận đơn ' ?></button> </td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading"><h4><span>Chi tiết đơn hàng </span><a class="pull-right" href="javascript:void(0)"><i class="icon-handbag"></i>Shop Now</a></h4></div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <?php $vesions = $model->versions; ?>
                    <?php //dbg($vesions) ?>
                <table class="table table-hover" style="padding: 30px;">
                    <thead>
                        
                        <tr>
                            <th class="text-center">STT</th>
                            <th class="text-left">Sản phẩm</th>
                            <th>Phiên bản</th>
                            <th class="text-right">Số lượng</th>
                            <th class="text-right">Giá gốc</th>
                            <th class="text-right">Giá bán</th>
                            <th class="text-right">Thành tiền</th>
                            <!-- <th class="text-center">Action</th> -->
                        </tr>
                    </thead>

                    <tbody>
                        <?php $total = $amount = 0; if ($vesions):  foreach ($vesions as $key => $value): ?>
                            <?php 
                            
                            if ($value->pro_version !='') {
                                $verson = $value->proOneVersion;
// dbg($verson);
                            }
                            ?>
                            <?php if (isset($value->proOneVersion)): ?>
                                <tr>
                                    <td class="text-center" rowspan="3"><?= $key+1 ?></td>
                                    <td rowspan="3"><?= $value->product->pro_name ?></td>
                                    <td rowspan="3"><?= $value->proOneVersion->name; ?></td>

                                    <td class="text-right"><span class="pull-left"> Giá 1:</span> <?= ($value->version_amount_price_sale_1 !=0) ? Yii::$app->formatter->asDecimal($value->version_amount_price_sale_1) : 0; ?></td>
                                    <td class="text-right"> <?= ($value->version_price_1 !=0) ? Yii::$app->formatter->asDecimal($value->version_price_1) : 'Báo giá'; ?></td>
                                    <td class="text-right"> <?= ($value->version_price_sale_1 !=0) ? Yii::$app->formatter->asDecimal($value->version_price_sale_1) : 'Báo giá'; ?></td>

                                    <td class="text-right">
                                        <?php 
                                        if ($value->version_price_sale_1=='') {
                                             $item  =  $value->version_amount_price_sale_1*$value->version_price_1;
                                             // echo Yii::$app->formatter->asDecimal();
                                        } else {
                                             $item =  $value->version_amount_price_sale_1*$value->version_price_sale_1;
                                        }
                                        $total += $item ;
                                            echo Yii::$app->formatter->asDecimal($item);
                                         ?>
                                         
                                     </td>

                                    <!-- <td class="text-center" rowspan="3"><button type="button" class="btn btn-info btn-outline btn-circle btn-sm m-r-5"><i class="icon-trash"></i></button></td> -->
                                </tr>
                                <tr>
                                    <td class="text-right"> <span class="pull-left"> Giá 2:</span>  <?= ($value->version_amount_price_2 !=0) ? Yii::$app->formatter->asDecimal($value->version_amount_price_2) : 0; ?></td>
                                    <td class="text-right"> - </td>
                                    <td class="text-right"> <?= ($value->version_price_2 !=0) ? Yii::$app->formatter->asDecimal($value->version_price_2) : 'Báo giá'; ?></td>

                                    <td class="text-right"> <?php
                                    $total += $item = $value->version_amount_price_2*$value->version_price_2;
                                    echo Yii::$app->formatter->asDecimal($item); ?> 
                                    
                                </td>
                                </tr>
                                
                                <tr>
                                    <td class="text-right"> <span class="pull-left"> Giá 3:</span>  <?= ($value->version_amount_price_3 !=0) ? Yii::$app->formatter->asDecimal($value->version_amount_price_3) : 0; ?></td>
                                    <td class="text-right"> - </td>
                                    <td class="text-right"> <?= ($value->version_price_3 !=0) ? Yii::$app->formatter->asDecimal($value->version_price_3) : 'Báo giá'; ?></td>

                                    <td class="text-right"> <?php
                                        $total += $item = $value->version_amount_price_3*$value->version_price_3;
                                     echo Yii::$app->formatter->asDecimal( $item) ; ?> </td>
                                </tr>
                                
                            <?php else: ?>
                                <tr>
                                    <td class="text-center"><?= $key+1 ?></td>
                                    <td>
                                        <?php if (isset($value->product->pro_name)): ?>
                                            <?= $value->product->pro_name ?>
                                        <?php else: ?>
                                            <p class="text-danger"> Sản phẩm này bị xóa hoặc ko có</p>
                                            <p>SP xóa : <b class="btn btn-outline btn-info"><?= $value->pro_name ?></b> </p>
                                        <?php endif ?>
                                    </td>
                                    <td>Ko</td>
                                    <td class="text-right"> <?= ($value->pro_amount !=0) ? $value->pro_amount : 0; ?> </td>
                                    <td class="text-right"><?= ($value->pro_price==null)? 0 : Yii::$app->formatter->asDecimal($value->pro_price) ?></td>
                                    <td class="text-right"><?= ($value->price_sales==null)? 0 : Yii::$app->formatter->asDecimal($value->price_sales) ?></td>
                                    <td class="text-right"><?php
                                     $total += $item = ($value->price_sales ==0 )? $value->pro_price*$value->pro_amount :$value->price_sales*$value->pro_amount ;
                                     echo Yii::$app->formatter->asDecimal($item);
                                     ?>
                                         
                                     </td>
                                    <!-- <td class="text-center"><button type="button" class="btn btn-info btn-outline btn-circle btn-sm m-r-5"><i class="icon-trash"></i></button></td> -->
                                </tr>
                            <?php endif ?>
                            
                        <?php endforeach ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5">Hiện tại đơn hàng ko có sản phẩm nào</td>
                            </tr>
                        <?php endif ?>
                        
                    </tbody>
                </table>
                </div>
                <div class="panel-footer"> Tổng tiền :  <span class="pull-right"><?= Yii::$app->formatter->asDecimal($total); ?></span></div>
            </div>
        </div>
    </div>

    <?php DetailView::widget([
        'model' => $model,
        'attributes' => [
            'order_id',
            'user_id',
            'fullname',
            'email:email',
            'phone',
            'address',
            'delivery_date',
            'user_ship',
            'mobile_ship',
            'status',
            'created_at',
            'updated_at',
            'userUpdated',
        ],
    ]) ?>

</div>
<?php
$this->registerJsFile("@web/js/product/product_order.js", ['depends' => [yii\web\JqueryAsset::className()]]);
?>