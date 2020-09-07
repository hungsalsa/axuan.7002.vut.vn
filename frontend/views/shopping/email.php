<?php use yii\helpers\Html;use yii\helpers\Url;
$data_thanhtoan = ['nha' => 'Thanh toán tại nhà', 'congty' => 'Thanh toán tại công ty', 'chuyenkhoan' => 'Thanh toán chuyển khoản'];?><h1>Cảm ơn Anh/Chị<?=$data['khachhang']['fullname']?>đã đặt hàng của chúng tôi, dưới đây là chi tiết đơn hàng :</h1><table style="width:80%;border:1px dotted;border-collapse:collapse"><thead><tr><th colspan="2"style="color:#00f;font-size:20px;padding:10px">Thông tin khách hàng</th></tr></thead><tbody><tr><td style="border:1px dotted">Tên đầy đủ</td><td style="border:1px dotted"><?=$data['khachhang']['fullname']?></td></tr><tr><td style="border:1px dotted">Số điện thoại</td><td style="border:1px dotted"><?=$data['khachhang']['phone']?></td></tr><tr><td style="border:1px dotted">Email</td><td style="border:1px dotted"><?=$data['khachhang']['email']?></td></tr><tr><td style="border:1px dotted">Địa chỉ</td><td style="border:1px dotted"><?=$data['khachhang']['address']?></td></tr><tr><td style="border:1px dotted">Thanh toán</td><td style="border:1px dotted"><?=$data_thanhtoan[$data['khachhang']['payment_orders']]?></td></tr><tr><td style="border:1px dotted">Ghi chú</td><td style="border:1px dotted"><?=$data['khachhang']['note']?></td></tr></tbody></table><br><hr><br><table style="width:80%;border:1px dotted;border-collapse:collapse"><thead><tr><th colspan="4"class="text-center"style="color:#00f;font-size:20px;padding:10px">Chi tiết đơn hàng</th></tr></thead><tbody><?php $count = $subtotal = $amount = 0;if ($data['cart']): foreach ($data['cart'] as $key => $value): $count++;?><?php $today = date("Y-m-d");if (isset($value['versions'])): ?><tr><td style="border:1px dotted;padding-left:7%"rowspan="5"><?=$count?></td><td style="border:1px dotted"colspan="3"><h4><a style="text-decoration:none"href="<?=Url::to(['product/view', 'slugCate' => $value['slugCate'], 'slug' => $value['slug']], true)?>"id="txtPro_<?=$key?>"><img style="float:left"src="<?=Yii::$app->request->hostInfo . $value['image']?>"width="65px"alt=""> <span><?=$value['pro_name']?></span></a></h4></td></tr><tr><td style="border:1px dotted"colspan="2">Ngày : <span><?=Yii::$app->formatter->asDate($value['date'], 'dd-MM-Y')?></span><?php if ($value['versions']['name'] != ''): ?>Mã: <span><?=$value['versions']['name']?></span><?php endif?></td><td style="border:1px dotted;text-align:right">Thành tiền :</td></tr><tr><td colspan="2"style="border:1px dotted">Giá 1:<?php if ($value['versions']['price_sale_1'] <= 0 || $value['versions']['price_sale_1'] == ''): ?><?php if ($value['versions']['price_1'] <= 0): $total_item = 0;?><span>Yêu cầu báo giá</span><?php else:$total_item = $value['versions']['price_1'] * $value['versions']['amount_price_sale_1'];?><span><?=number_format((int) $value['versions']['price_1'], 0, ',', '.')?></span><?php endif?><?php else:$total_item = $value['versions']['price_sale_1'] * $value['versions']['amount_price_sale_1'];?><?php if ($value['versions']['price_1'] <= 0 || $value['versions']['price_1'] <= 0): ?><span><?=number_format((int) $value['versions']['price_sale_1'], 0, ',', '.')?></span><?php else: ?><span><?=number_format((int) $value['versions']['price_sale_1'], 0, ',', '.')?><sup>đ</sup></span> <span><i><del><?=number_format((int) $value['versions']['price_1'], 0, ',', '.')?><sup>đ</sup></del></i></span><?php endif?><?php endif?>x :<?php echo $value['versions']['amount_price_sale_1']; ?></td><td style="border:1px dotted;text-align:right"><?php $subtotal += $total_item;
echo number_format((int) $total_item, 0, ',', '.')?></td></tr><tr><td colspan="2"style="border:1px dotted"><?php if ($value['versions']['price_2'] > 0): ?>Giá :<?=number_format($value['versions']['price_2'], 0, '.', '.')?>x<?=$value['versions']['amount_price_2']?>=<?php $subtotal += (int) $value['versions']['price_2'] * $value['versions']['amount_price_2']?><?php endif?></td><td style="border:1px dotted;text-align:right"><?=number_format($value['versions']['price_2'] * $value['versions']['amount_price_2'], 0, '.', '.')?></td></tr><tr><td colspan="2"style="border:1px dotted"><?php if ($value['versions']['price_3'] > 0): ?>Giá :<?=number_format($value['versions']['price_3'], 0, '.', '.')?>x<?=$value['versions']['amount_price_sale_1']?>=<?php $subtotal += (int) $value['versions']['price_3'] * $value['versions']['amount_price_3']?><?php endif?></td><td style="border:1px dotted;text-align:right"><?=number_format($value['versions']['price_3'] * $value['versions']['amount_price_3'], 0, '.', '.')?></td></tr><?php else: ?><?php if ($value['start_sale'] != '' && $value['end_sale'] != '' && $value['start_sale'] <= $today && $today <= $value['end_sale'] && $value['price_sales'] != ''): ?><tr><td style="border:1px dotted;padding-left:7%"><?=$count?></td><td style="border:1px dotted"colspan="2"><h4><a style="text-decoration:none"href="<?=Url::to(['product/view', 'slugCate' => $value['slugCate'], 'slug' => $value['slug']])?>"id="txtPro_<?=$key?>"><img style="float:left"src="<?=Yii::$app->request->hostInfo . $value['image']?>"width="65px"alt=""> <span><?=$value['pro_name']?></span></a></h4><span id="price-1_<?=$key?>"><?=number_format($value['price_sales'], 0, '.', '.')?></span><span>x </span><span>= </span><span class="quantity"><?=$value['amount']?></span></td><td style="border:1px dotted;text-align:right"><span><?=number_format($value['price_sales'] * $value['amount'], 0, '.', '.')?></span></td></tr><?php $subtotal += (int) $value['price_sales'] * $value['amount']?><?php $amount += (int) $value['amount']?><?php elseif ($value['price'] > 0): ?><tr><td style="border:1px dotted"><?=$count?></td><td style="border:1px dotted"colspan="2"><h4><a style="text-decoration:none"href="<?=Url::to(['product/view', 'slugCate' => $value['slugCate'], 'slug' => $value['slug']])?>"id="txtPro_<?=$key?>"><img style="float:left"src="<?=Yii::$app->request->hostInfo . $value['image']?>"width="65px"alt=""> <span><?=$value['pro_name']?></span></a></h4><span id="price-1_<?=$key?>"><?=number_format($value['price'], 0, '.', '.')?></span><span>x </span><span class="quantity"><?=$value['amount']?></span><span>=</span></td><td style="border:1px dotted;text-align:right"><span><?=number_format($value['price'] * $value['amount'], 0, '.', '.')?></span></td></tr><?php else: ?><?php $amount += (int) $value['amount']?><tr><td style="border:1px dotted"><?=$count?></td><td style="border:1px dotted"colspan="2"><h4><a style="text-decoration:none"href="<?=Url::to(['product/view', 'slugCate' => $value['slugCate'], 'slug' => $value['slug']])?>"id="txtPro_<?=$key?>"><img style="float:left"src="<?=Yii::$app->request->hostInfo . $value['image']?>"width="65px"alt=""> <span><?=$value['pro_name']?></span></a></h4><span>x<?=$value['amount']?></span></td><td style="border:1px dotted;text-align:right"><span>Yêu cầu báo giá</span></td></tr><?php endif?><?php endif?><?php endforeach?><?php endif?></tbody><tfoot><tr><td style="border:1px dotted">Tạm tính :</td><td colspan="3"style="border:1px dotted;text-align:right"><?=number_format($subtotal, 0, '.', '.')?></td></tr><tr><td style="border:1px dotted">Giảm giá :</td><td colspan="3"style="border:1px dotted;text-align:right">0</td></tr><tr><td style="border:1px dotted">Tổng tiền :</td><td colspan="3"style="border:1px dotted;text-align:right"><?=number_format($subtotal, 0, '.', '.')?></td></tr><tr><td style="border:1px dotted">Bằng chữ :</td><td colspan="3"style="padding:10px;font-size:16px;font-weight:600;font-style:italic"></td></tr></tfoot></table>