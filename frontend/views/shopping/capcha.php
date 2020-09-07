<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url; use common\libs\Docso; $docso = new Docso();use yii\captcha\Captcha; ?>
<!-- <script src="https://www.google.com/recaptcha/api.js?render=_reCAPTCHA_site_key"></script> -->
<style type="text/css">
	.help-block{color: red;}
</style>
<div class="col-lg-6 col-xl-6" id="listCartShopping">
	<?php $subtotal = $amount = 0; if ($cart): foreach ($cart as $key => $value): ?>
	<?php $today = date("Y-m-d"); if(isset($value['versions'])): ?>
		<div class="productInfo">
			<div class="imgPro">
				<a href="<?= Url::to(['product/view', 'slugCate' => $value['slugCate'], 'slug' => $value['slug']]) ?>"><img src="/<?= $value['image'] ?>" width="100px" alt=""></a>
			</div>
			<div class="infoAll">
				<h2><a href="<?= Url::to(['product/view', 'slugCate' => $value['slugCate'], 'slug' => $value['slug']]) ?>"><?= $value['pro_name'] ?></a></h2>
				Khởi hành: <span><?= Yii::$app->formatter->asDate($value['date'], 'dd-MM-Y'); ?></span> Mã: <span>BMLLLLL</span><!--Ko có dữ liệu thì ẩn-->
				<div class="info-1">
					<span id="price-1"><?= number_format($value['versions']['price_sale_1'],0,'.','.') ?><sup>đ</sup></span>
					<span> x </span>
					<span><input id="quantity_price_sale_1_<?= $key ?>" style="width:3.5em;height:1.5em" onchange="onchangeAmount(<?= $key ?>,'price_sale_1')" min="1" type="number" value="<?= $value['versions']['amount_price_sale_1'] ?>"></span>
					<span> = </span>
					<span id="sum"><?= number_format($value['versions']['price_sale_1']*$value['versions']['amount_price_sale_1'],0,'.','.') ?><sup>đ</sup></span>
					<?php $subtotal += (int)$value['versions']['price_sale_1']*$value['versions']['amount_price_sale_1'] ?>
				</div>
				<div class="info-2">
					<span id="price-1"><?= number_format($value['versions']['price_2'],0,'.','.') ?><sup>đ</sup></span>
					<span> x </span>
					<span><input style="width:3.5em;height:1.5em" type="number" onchange="onchangeAmount(<?= $key ?>,'price_2')" id="quantity_price_2_<?= $key ?>" min="1" value="<?= $value['versions']['amount_price_2'] ?>"></span>
					<span> = </span>
					<span id="sum"><?= number_format($value['versions']['price_2']*$value['versions']['amount_price_2'],0,'.','.') ?><sup>đ</sup></span>
					<?php $subtotal += (int)$value['versions']['price_2']*$value['versions']['amount_price_2'] ?>
				</div>
				<div class="info-3">
					<span id="price-1"><?= number_format($value['versions']['price_3'],0,'.','.') ?><sup>đ</sup></span>
					<span> x </span>
					<span><input style="width:3.5em;height:1.5em" type="number" onchange="onchangeAmount(<?= $key ?>,'price_2')" id="quantity_price_3_<?= $key ?>" min="1" value="<?= $value['versions']['amount_price_3'] ?>"></span>
					<span> = </span>
					<span id="sum"><?= number_format($value['versions']['price_3']*$value['versions']['amount_price_3'],0,'.','.') ?><sup>đ</sup></span>
					<?php $subtotal += (int)$value['versions']['price_3']*$value['versions']['amount_price_3'] ?>
				</div>
				<div id="del-cart"><i class="far fa-trash-alt"></i> Bỏ sản phẩm</div>
			</div>
		</div>
		<?php $amount += (int)$value['amount']*3 ?>
	<?php elseif ($value['start_sale']!='' && $value['end_sale']!='' && $value['start_sale']<=$today && $today <= $value['end_sale'] && $value['price_sales']!=''): ?>
		<div class="productInfo">
			<div class="imgPro">
				<a href="<?= Url::to(['product/view', 'slugCate' => $value['slugCate'], 'slug' => $value['slug']]) ?>"><img src="/<?= $value['image'] ?>" width="100px" alt=""></a>
			</div>
			<div class="infoAll">
				<h2><a href="<?= Url::to(['product/view', 'slugCate' => $value['slugCate'], 'slug' => $value['slug']]) ?>"><?= $value['pro_name'] ?></a></h2>
				<div class="info-1">
					<span id="price-1"><?= number_format($value['price_sales'],0,'.','.') ?><sup>đ</sup></span>
					<span> x </span>
					<span><input onchange="onchangeAmount(<?= $key ?>) "id="quantity_<?= $key ?>" style="width:3.5em;height:1.5em" min="1" type="number" value="<?= $value['amount'] ?>"></span>
					<span> = </span>
					<span id="sum"><?= number_format($value['price']*$value['amount'],0,'.','.') ?><sup>đ</sup></span>
				</div>
				<div id="del-cart"><i class="far fa-trash-alt"></i> Bỏ sản phẩm</div>
			</div>
		</div>
		<?php $subtotal += (int)$value['price_sales']*$value['amount'] ?>
		<?php $amount += (int)$value['amount'] ?>
	<?php else: ?>
		<?php $amount += (int)$value['amount'] ?>
		<div class="productInfo">
			<div class="imgPro">
				<a href="<?= Url::to(['product/view', 'slugCate' => $value['slugCate'], 'slug' => $value['slug']]) ?>"><img src="/<?= $value['image'] ?>" width="100px" alt=""></a>
			</div>
			<div class="infoAll">
				<h2><a href="<?= Url::to(['product/view', 'slugCate' => $value['slugCate'], 'slug' => $value['slug']]) ?>"><?= $value['pro_name'] ?></a></h2>

				<div class="info-1">
					<span>Số lượng </span>
					<span><input style="width:3.5em;height:1.5em" type="number" onchange="onchangeAmount(<?= $key ?>)" id="quantity_<?= $key ?>" min="1" value="<?= $value['amount'] ?>"></span>
					<span>Yêu cầu báo giá</span>
				</div>
				<div id="del-cart"><i class="far fa-trash-alt"></i> Bỏ sản phẩm</div>
			</div>
		</div>
		
	<?php endif;endforeach;endif ?>
	<hr>
	<div class="boxTotal-1">
		<div class="title">Tạm tính</div>
		<div class="sum"><?= number_format($subtotal,0,'.','.') ?><sup>đ</sup></div>
	</div>
	<div class="discount">
		<div class="title">Giảm giá</div>
		<div class="sum">0<sup>đ</sup></div>
	</div>
	<div class="boxTotal-2">
		<div class="title">Tổng tiền</div>
		<div class="sum"><?= number_format($subtotal,0,'.','.') ?><sup>đ</sup></div>
	</div>
</div>
<div class="col-lg-6 col-xl-6">
	<?php $form = ActiveForm::begin(); ?>
		<div class="row">
			<div class="col-sm-8" style="position: relative;">
				<div class="form-group">
					<label>Tên đầy đủ <span style="color: red">(*)</span></label>
					<!-- <div class="col-sm-8"> -->
						<?= $form->field($model, 'fullname')->textInput(['maxlength' => true,"placeholder"=>"Nhập tên đầy đủ"])->label(false) ?>
						<!-- </div> -->
					</div>
					<div class="form-group">
						<label for="inputPhone">Số điện thoại <span style="color: red">(*)</span></label>
						<!-- <div class="col-sm-8"> -->
						<?= $form->field($model, 'phone')->textInput(['maxlength' => true,"placeholder"=>"Nhập số điện thoại", "id"=>"inputPhone"])->label(false) ?>
							<!-- </div> -->
						</div>
						<div class="form-group">
							<label for="inputemail">Email</label>
							<?= $form->field($model, 'email')->textInput(['maxlength' => true,"placeholder"=>"Nhập số email", "id"=>"inputemail"])->label(false) ?>
							<!-- <span>Chi tiết đơn hàng sẽ được gửi vào email</span> -->
						</div>
						<div class="form-group">
							<label for="address">Địa chỉ <span style="color: red">(*)</span></label>
							<?= $form->field($model, 'address')->textInput(['maxlength' => true,"placeholder"=>"Địa chỉ giao hàng", "id"=>"address"])->label(false) ?>
							<!-- <span>Chi tiết đơn hàng sẽ được gửi vào email</span> -->
						</div>
						<div class="form-group">
							<label for="exampleFormControlTextarea1">Ghi chú</label>
							<?= $form->field($model, 'note')->textarea(['rows' => 3,'id'=>'exampleFormControlTextarea1'])->label(false) ?>
						</div>
						<div class="btn">
							<div class="g-recaptcha" data-sitekey="6LdIl-sUAAAAAB2IOSIP_y3eIhTGAFwoPUCfYGP5"></div>
							<?= $form->field($model, 'reCaptcha')->widget(
								\himiklab\yii2\recaptcha\ReCaptcha2::className(),
								[
							        'siteKey' => '6LdIl-sUAAAAAB2IOSIP_y3eIhTGAFwoPUCfYGP5', // unnecessary is reCaptcha component was set up
							    ]
							)->label(false) ?>

							<!-- Mã Captcha -->
							<!-- Có thông báo gửi thành công -->
							<?= Html::submitButton('Đặt hàng', ['class' => 'btn btn-success btn_luu']) ?>
						</div>
					</div>
					<!-- <div class="col-sm-4"> -->
						<!-- <br><br><br><br> -->
						<!-- </div> -->
					</div>
				<?php ActiveForm::end(); ?>
</div>

<!-- </div> -->
<!-- /.row -->
<?php 
$this->registerJsFile("@web/js/checkout.js", ['depends' => [yii\web\JqueryAsset::className()]]);