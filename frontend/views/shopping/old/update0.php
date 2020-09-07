<?php use yii\helpers\Url; use common\libs\Docso; $docso = new Docso() ?>
<table class="table table-bordered">
	<thead>
		<tr>
			<th class="cart-description item" width="10%">Ảnh</th>
			<th class="cart-product-name item" width="40%">Tên sản phẩm</th>
			<th class="cart-qty item" width="12%">Số lượng</th>
			<th class="cart-sub-total item">Giá</th>
			<th class="cart-total last-item">Thành tiền</th>
			<th class="cart-romove item">Xóa</th>
		</tr>
	</thead>
	<!-- /thead --> 
	<tbody>
		<?php $subtotal = $amount = 0; if ($cart): 
		foreach ($cart as $key => $value): ?>
			<tr>
				<td class="cart-image">
					<a class="entry-thumbnail" href="Url::to(['product/view', 'slugCate' => $value['slugCate'], 'slug' => $value['slug']])"> <img id="img_<?= $key ?>" height="90px" src="/<?= $value['image'] ?>" alt=""></a>
				</td>
				<td class="cart-product-name-info">
					<h4 class='cart-product-description' id="txtPro_<?= $key ?>"><a href="<?= Url::to(['product/view', 'slugCate' => $value['slugCate'], 'slug' => $value['slug']]) ?>"><?= $value['pro_name'] ?></a></h4>
					<div class="cart-product-info"> 
						<span class="product-color">Hãng :  <?= $value['price_sales'];?></span> 
					</div>
				</td>
				<td class="cart-product-quantity">
					<div class="quant-input">
						<a class="itemDown" href="javascript:void(0)" onclick="itemDown(<?= $key ?>)" style=""><i class="fa fa-minus"></i></a>
						<input onchange="onchange_num(<?= $key ?>)" type="number" value="<?= $value['amount'] ?>" id="quantity_<?= $key ?>" name="quantity_<?= $key ?>" class="text-center form-control"> 
						<a class="itemUp" href="javascript:void(0)" onclick="itemUp(<?= $key ?>)" style=""><i class="fa fa-plus"></i></a>
						<?php $amount += (int)$value['amount'] ?>
					</div>
				</td>
				<td class="cart-product-sub-total text-right" id="txtPrice_<?= $key ?>"><span class="cart-sub-total-price text-right"><?= number_format($value['price_sales'],0,'.','.') ?></span></td>
				<td class="cart-product-grand-total text-right"><span class="cart-grand-total-price text-right" id="total_item_<?= $key ?>"><?= number_format($value['price_sales']*$value['amount'],0,'.','.') ?></span></td>
				<td class="romove-item text-center"><a href="javascript:void(0)" onclick="deleteItem(<?= $key ?>)" title="cancel" class="icon"><i class="fa fa-trash"></i></a></td>
				<?php $subtotal += (int)$value['price_sales']*$value['amount'] ?>
			</tr>
		<?php endforeach ?>
		<?php else: ?>
			<tr>
				<td colspan="6">Giỏ hàng của bạn đang rỗng</td>
			</tr>
		<?php endif ?>
	</tbody>
	<!-- /tbody --> 
	<tfoot>
		<tr>
			<td colspan="3" class="text-right">
				<div class="shopping-cart-btn">Tổng tiền : </div>
				<!-- /.shopping-cart-btn --> 
			</td>
			<td colspan="2" class="text-right"><strong>
				<?= number_format($subtotal,0,'.','.') ?></strong>
			</td>
			<td></td>
		</tr>
		<tr>
			<td>Bằng chữ :</td>
			<td colspan="5" class="text-right pr-4"><strong><?= $docso->convert_number_to_words($subtotal) ?></strong></td>
		</tr>
	</tfoot>
</table>
<!-- /table --> 

"***"
<ul style="padding: 0;margin: 0;max-height: 430px;overflow-y: scroll;">    

   <span style="display: none;">
   </span> 
   <?php $totalAmount = $total = 0; if (isset($cart)): foreach ($cart as $value): $totalAmount += $value['amount'];
      $total += $value['price_sales']*$value['amount'];?>
      <li class="cart-top">
         <div class="cart-top-image">
            <img src="/<?= $value['image'] ?>" alt="<?= $value['pro_name'] ?>">
         </div>
         <div class="cart-top-info">
            <p><a href=""><?= $value['pro_name'] ?></a></p>
            <span class="cart-top-qty"><?= $value['amount'] ?> x </span>
            <span class="cart-top-price red"><?= Yii::$app->formatter->asDecimal($value['price_sales'],0) ?> <u>đ</u> </span> 
         </div>
      </li>
   <?php endforeach;endif; ?>

 </ul>
 <p class="border-top cart-top-total text-right">Tổng cộng : <span class="red"><?= Yii::$app->formatter->asDecimal($total,0) ?> <u>đ</u></span></p>
 <span class="cart-top-checkout"><a href="/shopping/gio-hang">Thanh toán ngay</a></span>
 "***"<?= ($cart)? count($cart) : 0 ?>