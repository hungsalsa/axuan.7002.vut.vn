<?php use yii\helpers\Url; use common\libs\Docso; $docso = new Docso();use yii\captcha\Captcha; ?>
<div class="col-lg-6 col-xl-6">
	<?php $subtotal = $amount = 0; if ($cart): foreach ($cart as $key => $value): ?>
	<div class="productInfo">
		<div class="imgPro">
			<a href="<?= Url::to(['product/view', 'slugCate' => $value['slugCate'], 'slug' => $value['slug']]) ?>"><img id="img_<?= $key ?>" src="/<?= $value['image'] ?>" width="100px" alt=""></a>
		</div>
		<div class="infoAll">
			<h2><a href="<?= Url::to(['product/view', 'slugCate' => $value['slugCate'], 'slug' => $value['slug']]) ?>"><?= $value['pro_name'] ?></a></h2>
			<?php if(isset($value['versions']) && array_key_exists($value['idVersion'],$value['versions'])): ?>
			Phiên bản : <span><?= $value['versions'][$value['idVersion']]['name'] ?></span> Mã: <span>BMLLLLL</span><!--Ko có dữ liệu thì ẩn-->
			<?php endif ?>
			<?php $today = date("Y-m-d"); if (isset($value['versions'])): ?>
				<div class="info-1">
					<span id="price-1">15.000.000<sup>đ</sup></span>
					<span> x </span>
					<span><input style="width:3.5em;height:1.5em" type="number" value="1"></span>
					<span> = </span>
					<span id="sum">15.000.000<sup>đ</sup></span>
				</div>
				<div class="info-2">
					<span id="price-1">100.000<sup>đ</sup></span>
					<span> x </span>
					<span><input style="width:3.5em;height:1.5em" type="number" value="1"></span>
					<span> = </span>
					<span id="sum">100.000<sup>đ</sup></span>
				</div>
					
				<?php elseif ($value['start_sale']!='' && $value['end_sale']!='' && $value['start_sale']<=$today && $today <= $value['end_sale'] && $value['price_sales']!=''): ?>
									
					<div class="info-1">
						<span id="price-1">15.000.000<sup>đ</sup></span>
						<span> x </span>
						<span><input style="width:3.5em;height:1.5em" type="number" value="1"></span>
						<span> = </span>
						<span id="sum">15.000.000<sup>đ</sup></span>
					</div>
					<div id="del-cart"><i class="far fa-trash-alt"></i> Bỏ sản phẩm</div>
				<?php else: ?>
					<div class="info-1">
						<span>Số lượng </span>
						<span><input style="width:3.5em;height:1.5em" type="number" value="1"></span>
						<span>Yêu cầu báo giá</span>
					</div>
					<div id="del-cart"><i class="far fa-trash-alt"></i> Bỏ sản phẩm</div>
			<?php endif ?>

		</div>
	</div>
<?php endforeach;endif ?>
	
	<div class="boxDiscount">
		<div class="title">Bạn có mã giảm giá không?</div>
		<div class="input-group mb-3">
			<input type="text" class="form-control" placeholder="Nhập mã giảm giá" aria-label="Nhập mã giảm giá" aria-describedby="button-addon2">
			<div class="input-group-append">
				<button class="btn btn-outline-secondary" type="button" id="button-addon2">Áp dụng</button>
			</div>
		</div>
	</div><hr>
	<div class="boxTotal-1">
		<div class="title">Tạm tính</div>
		<div class="sum">32.000.000<sup>đ</sup></div>
	</div>
	<div class="discount">
		<div class="title">Giảm giá</div>
		<div class="sum">1.000.000<sup>đ</sup></div>
	</div>
	<div class="boxTotal-2">
		<div class="title">Tổng tiền</div>
		<div class="sum">31.000.000<sup>đ</sup></div>
	</div>
</div>
<div class="col-lg-6 col-xl-6">
	<form>
		<div class="row">
			<div class="col-sm-8" style="position: relative;">
				<div class="form-group">
					<label>Tên đầy đủ <span style="color: red">(*)</span></label>
					<!-- <div class="col-sm-8"> -->
						<input type="text" name="fullname" class="form-control unicase-form-control text-input" placeholder="Nhập tên đầy đủ" required="required"> 
						<!-- </div> -->
					</div>
					<div class="form-group">
						<label for="inputPhone">Số điện thoại <span style="color: red">(*)</span></label>
						<!-- <div class="col-sm-8"> -->
							<input id="inputPhone" type="text" name="phone" class="form-control unicase-form-control text-input" placeholder="Nhập số điện thoại" required="required"> 
							<!-- </div> -->
						</div>
						<div class="form-group">
							<label for="inputPassword">Email</label>
							<input type="email" name="email" class="form-control unicase-form-control text-input" placeholder="Nhập email">
							<!-- <span>Chi tiết đơn hàng sẽ được gửi vào email</span> -->
						</div>
						<div class="form-group">
							<label for="address">Địa chỉ <span style="color: red">(*)</span></label>
							<input type="text" name="address" id="address" class="form-control unicase-form-control text-input" placeholder="Địa chỉ giao hàng" required="required">
							<!-- <span>Chi tiết đơn hàng sẽ được gửi vào email</span> -->
						</div>
						<div class="form-group">
							<label for="exampleFormControlTextarea1">Ghi chú</label>
							<textarea class="form-control" name="note" id="exampleFormControlTextarea1" rows="3"></textarea>
						</div>
						<div class="btn">
							<?=  Captcha::widget([
    'name' => 'captcha',
]); ?>
							Mã Captcha
							<button type="submit" class="btn btn-primary">Liên hệ</button>
							<!-- Có thông báo gửi thành công -->
							<button type="submit" class="btn btn-primary">Đặt hàng</button>
						</div>
					</div>
					<!-- <div class="col-sm-4"> -->
						<!-- <br><br><br><br> -->
						<!-- </div> -->
					</div>
				</form>
</div>

<!-- </div> -->
<!-- /.row -->
<?php 
$this->registerJsFile("@web/js/checkout.js", ['depends' => [yii\web\JqueryAsset::className()]]);