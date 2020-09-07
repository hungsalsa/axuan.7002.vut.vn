<?php
use yii\helpers\Url;
$this->title = 'Administrator';
$order = $data['order'];
$customer= $data['customer'];
?>
<!-- /.row -->
<!-- ============================================================== -->
<!-- Different data widgets -->
<!-- ============================================================== -->
<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <div class="row row-in">
                <div class="col-lg-4 col-sm-6 row-in-br  b-r-none">
                    <ul class="col-in">
                        <li>
                            <span class="circle circle-md bg-info"><i class="ti-wallet"></i></span>
                        </li>
                        <li class="col-last">
                            <h3 class="counter text-right m-t-15"><?= $customer['not_activated'] ?></h3>
                        </li>
                        <li class="col-middle" style="width:72%">
                            <h4>Tổng số khách hàng liên hệ qua form trang chủ & bài viết chưa xử lý</h4>
                            <div class="progress">
                                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?= ($customer['total']==0)? 0 : $customer['not_activated']/$customer['total']*100 ?>%">
                                    <span class="sr-only">40% Complete (success)</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-4 col-sm-6 row-in-br">
                    <ul class="col-in">
                        <li>
                            <span class="circle circle-md bg-success"><i class=" ti-shopping-cart"></i></span>
                        </li>
                        <li class="col-last">
                            <h3 class="counter text-right m-t-15"><?= $order['not_activated']; ?></h3>
                        </li>
                        <li class="col-middle" style="width:72%">
                            <h4>Tổng số đơn hàng sản phẩm chưa xử lý</h4>
                            <div class="progress">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?= ($order['total']==0)? 0 : $order['not_activated']/$order['total']*100 ?>%">
                                    <span class="sr-only">40% Complete (success)</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--row -->
<!-- /.row -->
<div class="row">
   <?php if ($customer['rows']): ?>
        <div class="col-md-6 col-lg-6 col-sm-12">
            <div class="panel">
                <div class="panel-heading text-center"><h2><a target="_blank" href="<?= Url::to(['/customer/customer'],true) ?>">Liên hệ từ form trang chủ & bài viết chưa xử lý</a></h2></div>
                <div class="table-responsive">
                    <table class="table table-hover manage-u-table">
                        <thead>
                            <tr>
                                <th style="width: 70px;" class="text-center">STT</th>
                                <th>Họ tên</th>
                                <!-- <th>OCCUPATION</th> -->
                                <th>Số điện thoại</th>
                                <th>Email</th>
                                <!-- <th>Liên hệ</th>type -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($customer['rows'] as $key => $custo): ?>
                            <tr>
                                <td class="text-center"><?=  $key +1 ?></td>
                                <td><span class="font-medium"><?= $custo['fullname'] ?></span> </td>
                                <td><span class="font-medium"><?= $custo['phone'] ?></span> </td>
                                <td><span class="font-medium"><?= $custo['email'] ?></span> </td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php endif ?>

    <?php if ($order['rows']): ?>
        <div class="col-md-6 col-lg-6 col-sm-12">
            <div class="panel">
                <div class="panel-heading text-center"><h2><a target="_blank" href="<?= Url::to(['/products/order'],true) ?>">Đơn hàng sản phẩm chưa xử lý</a></h2></div>
                <div class="table-responsive">
                    <table class="table table-hover manage-u-table">
                        <thead>
                            <tr>
                                <th style="width: 70px;" class="text-center">STT</th>
                                <th>Họ tên</th>
                                <!-- <th>OCCUPATION</th> -->
                                <th>Số điện thoại</th>
                                <th>Email</th>
                                <!-- <th>Liên hệ</th>type -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($order['rows'] as $key => $ord): ?>
                            <tr>
                                <td class="text-center"><?=  $key +1 ?></td>
                                <td><span class="font-medium"><?= $ord->khachhang->fullname ?></span> </td>
                                <td><span class="font-medium"><?= $ord->khachhang->phone ?></span> </td>
                                <td><span class="font-medium"><?= $ord->khachhang->email ?></span> </td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php endif ?>
    <div class="col-md-6 col-lg-6 col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Form liên hệ</h3>
            </div>
            <div class="panel-body">
                Form liên hệ : <a target="_blank" href="/khach-hang/lien-he" title="">/khach-hang/lien-he</a>
            </div>
        </div>
    </div>
</div>