<?php 
use kartik\number\NumberControl;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;use common\libs\Docso;$docso = new Docso();use yii\captcha\Captcha; 
// $saveCont = ['class' => 'kv-saved-cont'];
// $dispOptions = ['class' => 'form-control kv-monospace'];
?>

<div class="col-lg-6 col-xl-6" id="listCartShopping">
	<div class="row list_product">
		<?php $subtotal = $amount = 0; if ($cart): 
		foreach ($cart as $key => $value):  ?>
			<?php $today = date("Y-m-d"); 

			if($value['idVersion'] > 0): ?>
				
				<div class="productInfo col-md-12">
					<div class="imgPro float-left">
						<a href="<?= Url::to(['product/view', 'slugCate' => $value['slugCate'], 'slug' => $value['slug']]) ?>"><img id="img_<?= $key ?>" src="<?= $value['image'] ?>" width="100px" alt=""></a>
					</div>

					<div class="infoAll float-right">
						<h2><a href="<?= Url::to(['product/view', 'slugCate' => $value['slugCate'], 'slug' => $value['slug']]) ?>" id="txtPro_<?= $key ?>"><?= $value['pro_name'] ?></a></h2>
						Khởi hành: <span><?= isset($value['date']) ? Yii::$app->formatter->asDate($value['date'], 'dd-MM-Y'):''; ?></span> 
						Mã: <span>
							<?=  isset($value['versions']['name']) ? $value['versions']['name']:'' ?>

						</span><!--Ko có dữ liệu thì ẩn--> 
					
							<!-- gias thu 1 -->
							<div class="info-1">
								<?php if ($value['versions']['price_sale_1']>0): $subtotal += $total_item = (int)$value['versions']['price_sale_1']*$value['versions']['amount_price_sale_1']?>
									<span id="price-1_<?= $key ?>"><?= number_format($value['versions']['price_sale_1'],0,'.','.') ?><sup>đ</sup></span>
								<?php else: $subtotal += $total_item = (int)$value['versions']['price_1']*$value['versions']['amount_price_sale_1']?>
									<span id="price-1_<?= $key ?>"><?= number_format($value['versions']['price_1'],0,'.','.') ?><sup>đ</sup></span>
								<?php endif ?>
								
								<span> x </span>
								<span>
									

									<?= NumberControl::widget([
											'name' => 'quantity_price_3_'.$key,
											'value' =>  $value['versions']['amount_price_sale_1'],
											'options' => [
												'placeholder' => 'Enter a valid phone number...',
												
											],
											'displayOptions' => /*$dispOptions +*/[
												'placeholder' => 'Enter a valid phone number...',
												'id' => 'quantity_price_sale_1_'.$key,
												'class' => 'form-control',
												"onchange"=>"onchangeAmount($key,'price_sale_1')"
											],
											// 'saveInputContainer' => $saveCont,
											'maskedInputOptions' => [
												'prefix' => '',
												// 'suffix' => '',
												'allowMinus' => false,
												'groupSeparator' => '.',
												'radixPoint' => ','
											]
										]); ?>
								</span>
								<span class="equal"> = </span>

								<?php if ($value['versions']['price_sale_1']>0 || $value['versions']['price_1']>0): ?>
									<span class="float-right" id="sum_<?= $key ?>"><?= number_format($total_item,0,'.','.') ?><sup>đ</sup></span>

								<?php else: ?>
									<span class="float-right" >Yêu cầu báo giá</span>

								<?php endif; ?>
							</div>
							<!-- Gia thu 1: end -->

							<!-- Gia thu 2 -->
							<?php if ($value['versions']['price_2']> 0): ?>
								<div class="info-2">
									<span id="price-1_<?= $key ?>"><?= number_format($value['versions']['price_2'],0,'.','.') ?><sup>đ</sup></span>
									<span> x </span>
									<span>
										<?= NumberControl::widget([
											'name' => 'quantity_price_3_'.$key,
											'value' =>  $value['versions']['amount_price_2'],
											'options' => [
												'placeholder' => 'Enter a valid phone number...',
											],
											'displayOptions' => /*$dispOptions +*/[
												'class' => 'form-control',
												'placeholder' => 'Enter a valid phone number...',
												'id' => 'quantity_price_2_'.$key,
												"onchange"=>"onchangeAmount($key,'price_2')"
											],
											// 'saveInputContainer' => $saveCont,
											'maskedInputOptions' => [
												'prefix' => '',
												// 'suffix' => '',
												'allowMinus' => false,
												'groupSeparator' => '.',
												'radixPoint' => ','
											]
										]); ?>
									</span>
									<span class="equal"> = </span>
									<span class="float-right" id="sum_<?= $key ?>"><?= number_format($value['versions']['price_2']*$value['versions']['amount_price_2'],0,'.','.') ?><sup>đ</sup></span>
									<?php $subtotal += (int)$value['versions']['price_2']*$value['versions']['amount_price_2'] ?>

								</div>
							<?php endif ?>
							<!-- Gia thu 2: end -->
							<!-- Gia thu 3: start -->
							<?php if ($value['versions']['price_3']!=0): ?>
								<div class="info-3">
									<span id="price-1_<?= $key ?>"><?= number_format($value['versions']['price_3'],0,'.','.') ?><sup>đ</sup></span>
									<span> x </span>
									<span>

										<?= NumberControl::widget([
											'name' => 'quantity_price_3_'.$key,
											'value' =>  $value['versions']['amount_price_3'],
											'options' => [
												'placeholder' => 'Enter a valid phone number...',
											],
											'displayOptions' => /*$dispOptions +*/[
												'class' => 'form-control',
												'placeholder' => 'Enter a valid phone number...',
												'id' => 'quantity_price_3_'.$key,
												"onchange"=>"onchangeAmount($key,'price_3')"
											],
											// 'saveInputContainer' => $saveCont,
											'maskedInputOptions' => [
												'prefix' => '',
												// 'suffix' => '',
												'allowMinus' => false,
												'groupSeparator' => '.',
												'radixPoint' => ','
											]
										]); ?>

									</span>
									<span class="equal"> = </span>
									<span class="float-right" id="sum_<?= $key ?>"><?= number_format($value['versions']['price_3']*$value['versions']['amount_price_3'],0,'.','.') ?><sup>đ</sup></span>
									<?php $subtotal += (int)$value['versions']['price_3']*$value['versions']['amount_price_3'] ?>
								</div>
							<?php endif ?>
							<!-- Gia thu 3: end -->

							<div id="del-cart_<?= $key ?>"><a onclick="deleteItem(<?= $key ?>)" href="javascrip:void(0)" data-toggle="modal" data-target="#deleteshopping"><i class="far fa-trash-alt"></i> Bỏ sản phẩm</a></div>

					</div>
				</div>

			<?php else: ?>
	
				<!-- ko tồn tại -->
				<?php  $amount += (int)$value['amount']*3 ?>

					<div class="productInfo col-md-12">
						<div class="imgPro float-left">
							<a href="<?= Url::to(['product/view', 'slugCate' => $value['slugCate'], 'slug' => $value['slug']]) ?>"><img id="img_<?= $key ?>" src="<?= $value['image'] ?>" width="100px" alt=""></a>
						</div>
						<div class="infoAll float-right">
							<h2><a href="<?= Url::to(['product/view', 'slugCate' => $value['slugCate'], 'slug' => $value['slug']]) ?>" id="txtPro_<?= $key ?>"><?= $value['pro_name'] ?></a></h2>
							<div class="info-1">
	

									<?php if($value['start_sale']!='' && $value['end_sale']!='' && $value['start_sale']<=$today && $today <= $value['end_sale'] && $value['price_sales'] > 0): ?>
										<span id="price-1_<?= $key ?>">
											<?php echo number_format($value['price_sales'],0,'.','.'); $total_item = $value['price_sales']*$value['amount']; ?><sup>đ</sup>
										</span>
										<span> x </span>
									<?php else:?>
										<span><?php echo ($value['price']<= 0) ? null : number_format($value['price'],0,'.','.').'<sup>đ</sup><span> x </span>'; $total_item = ($value['price']<= 0) ? 0 : $value['price']*$value['amount']; ?></span>
									<?php endif ?>

								
								<span>
									<?= NumberControl::widget([
											'name' => 'amount',
											'value' => $value['amount'],
											'options' => [
												'placeholder' => 'Enter a valid phone number...',
											],
											'displayOptions' => [
												'class' => 'form-control',
												'placeholder' => 'Enter a valid phone number...',
												'id' => 'quantity_'.$key,
												"onchange"=>"onchangeAmount($key)"
											],
									// 'saveInputContainer' => $saveCont,
											'maskedInputOptions' => [
												'prefix' => '',
												// 'suffix' => '',
												'allowMinus' => false,
												'groupSeparator' => '.',
												'radixPoint' => ','
											]
										]); ?>

								</span>
								<span class="equal"> = </span>
								<span class="float-right" id="sum_<?= $key ?>">
										<?= ($total_item>0) ? number_format($total_item,0,'.','.').'<sup>đ</sup>': 'Yêu cầu báo giá' ?>
								</span>
							</div>
							<div id="del-cart_<?= $key ?>"><a onclick="deleteItem(<?= $key ?>)" href="javascrip:void(0)" data-toggle="modal" data-target="#deleteshopping"><i class="far fa-trash-alt"></i> Bỏ sản phẩm</a></div>
						</div>
					</div>
					<?php $subtotal += (int)$total_item;
					$amount += (int)$value['amount'] ?>
					<!-- ko tồn tại -->
			<?php endif;
		endforeach ?>
	</div>


	<div class="row total_money">

		<div class="boxTotal-1 col-md-12">
			<span class="title">Tạm tính :  </span>
			<span class="sum float-right"><?= number_format($subtotal,0,'.','.') ?><sup>đ</sup></span>
		</div>
		<div class="discount col-md-12">
			<span class="title">Giảm giá : </span>
			<span class="sum float-right">0<sup>đ</sup></span>
		</div>
		<div class="boxTotal-2 col-md-12">
			<span class="title"><b>Tổng tiền</b></span>
			<span class="sum float-right"><b><?= number_format($subtotal,0,'.','.') ?><sup>đ</sup></b></span>
		</div>


		<?php else: ?>
			Rỏ hàng của bạn đang rỗng
		<?php endif ?>
	</div>
</div>

<div class="col-lg-6 col-xl-6">
	<?php $form = ActiveForm::begin(['enableAjaxValidation' => true]); ?>
		<div class="row">
			<div class="col-sm-8" style="position: relative;">
				<div class="form-group">
					<label>Tên đầy đủ <span style="color: red">(*)</span></label>
					<!-- <div class="col-sm-8"> -->
						<?= $form->field($model, 'fullname')->textInput(['maxlength' => true,"placeholder"=>"Nhập tên đầy đủ",'value'=>isset($post)? $post['FOrder']['fullname'] : null])->label(false) ?>
						<!-- </div> -->
					</div>
					<div class="form-group">
						<label for="inputPhone">Số điện thoại <span style="color: red">(*)</span></label>
						<!-- <div class="col-sm-8"> -->
						<?= $form->field($model, 'phone')->textInput(['maxlength' => true,"placeholder"=>"Nhập số điện thoại", "id"=>"inputPhone",'value'=>isset($post)? $post['FOrder']['phone'] : null])->label(false) ?>
							<!-- </div> -->
						</div>
						<div class="form-group">
							<label for="inputemail">Email</label>
							<?= $form->field($model, 'email')->textInput(['maxlength' => true,"placeholder"=>"Nhập số email", "id"=>"inputemail",'value'=>isset($post)? $post['FOrder']['email'] : null])->label(false) ?>
							<!-- <span>Chi tiết đơn hàng sẽ được gửi vào email</span> -->
						</div>
						<div class="form-group">
							<label for="address">Địa chỉ <span style="color: red">(*)</span></label>
							<?= $form->field($model, 'address')->textInput(['maxlength' => true,"placeholder"=>"Địa chỉ giao hàng", "id"=>"address",'value'=>isset($post)? $post['FOrder']['address'] : null])->label(false) ?>
							<!-- <span>Chi tiết đơn hàng sẽ được gửi vào email</span> -->
						</div>
						<br>
						<div class="payment">
							<?= $form->field($model, 'payment_orders')->dropDownList(['nha'=>'Thanh toán tại nhà','congty'=>'Thanh toán tại công ty','chuyenkhoan'=>'Thanh toán chuyển khoản'], ['id'=>'Payment_orders']) ?>
							<div class="bank_account">
								<?= Yii::$app->params['config']['seohome']['bank_account'] ?>
							</div>
						</div>
						<div class="form-group">
							<label for="exampleFormControlTextarea1">Ghi chú</label>
							<?= $form->field($model, 'note')->textarea(['rows' => 3,'id'=>'exampleFormControlTextarea1','value'=>isset($post)? $post['FOrder']['note'] : null])->label(false) ?>
						</div>
						<div class="form-group">
							<div class="description_shopping">
								<?= Yii::$app->params['config']['seohome']['description_shopping'] ?>
							</div>
						</div>
						<div class="form-group">
							<div class="g-recaptcha" data-sitekey="6LdIl-sUAAAAAB2IOSIP_y3eIhTGAFwoPUCfYGP5"></div>
							<!-- <div class="g-recaptcha" data-sitekey="6LfFKfMUAAAAAEirNx5DEykvMylwijpV60r6hYDS"></div> -->
							<?php if (isset($post['g-recaptcha-response']) && $post['g-recaptcha-response']==''): ?>
								<div class="help-block">Recapcha chưa được chọn !</div>
							<?php endif ?>
						</div>
						<div class="btn">

							<!-- Mã Captcha -->
							<!-- Có thông báo gửi thành công -->
							<?php if ($cart): ?>
							<?= Html::submitButton('Đặt hàng', ['class' => 'btn btn-success btn_luu','id'=>'shopping_book']) ?>
							<?php endif ?>
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
// $this->registerJsFile("@web/js/checkout.js", ['depends' => [yii\web\JqueryAsset::className()]]);
?>
