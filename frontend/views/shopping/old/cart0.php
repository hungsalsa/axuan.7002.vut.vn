 <ul style="padding: 0;margin: 0;max-height: 430px;overflow-y: scroll;">    

 	<span style="display: none;">
 	</span> 
 	<?php $totalAmount = $total = 0; if (isset($infoCart)): foreach ($infoCart as $value): $totalAmount += $value['amount'];
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
 "***"<?= ($infoCart)? count($infoCart) : 0 ?>