<?php use yii\helpers\Url; use common\libs\Docso; $docso = new Docso() ?>
<h1>Giỏ hàng của bạn</h1>
<!-- <div class="row inner-bottom-sm"> -->
	<div class="shopping-cart">
		<div class="col-md-12 col-sm-12 shopping-cart-table ">
			<div class="table-responsive" id="listCart">
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
								<!-- <div class="row">
									<div class="col-sm-4">
										<div class="rating rateit-small"></div>
									</div>
									<div class="col-sm-8">
										<div class="reviews"> (06 Reviews) </div>
									</div>
								</div> -->
								<!-- /.row -->
								<?php if(isset($value['versions']) && array_key_exists($value['idVersion'],$value['versions'])): ?>
									<div class="cart-product-info"> 
										<!-- <span class="product-imel">IMEL:<span>084628312</span></span><br>  -->
										<span class="product-color">Phiên bản : <?= $value['versions'][$value['idVersion']]['name'] ?> </span> 
									</div>
								<?php endif ?> 
							</td>
							<td class="cart-product-quantity">
								<div class="quant-input">
									<a class="itemDown" href="javascript:void(0)" onclick="itemDown(<?= $key ?>)" style=""><i class="fa fa-minus"></i></a>
									<input onchange="onchange_num(<?= $key ?>)" type="number" value="<?= $value['amount'] ?>" id="quantity_<?= $key ?>" name="quantity_<?= $key ?>" class="text-center form-control"> 
									<a class="itemUp" href="javascript:void(0)" onclick="itemUp(<?= $key ?>)" style=""><i class="fa fa-plus"></i></a>
									<?php $amount += (int)$value['amount'] ?>
								</div>
							</td>
							<td class="cart-product-sub-total text-right" id="txtPrice_<?= $key ?>"><span class="cart-sub-total-price text-right"><?= number_format(isset($value['versions']) ? $value['versions'][$value['idVersion']]['price_sale']: $value['price_sales'],0,'.','.') ?></span></td>
							<td class="cart-product-grand-total text-right"><span class="cart-grand-total-price text-right" id="total_item_<?= $key ?>"><?= number_format((isset($value['versions']) ? $value['versions'][$value['idVersion']]['price_sale']: $value['price_sales'])*$value['amount'],0,'.','.') ?></span></td>
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
							<td colspan="5" class="text-right pr-4"><strong><?= ucfirst(strtolower($docso->convert_number_to_words($subtotal))) ?></strong></td>
						</tr>
					</tfoot>
				</table>
				<!-- /table --> 
			</div>
		</div>
		<!-- /.shopping-cart-table -->				
		 
		<div class="col-md-12 col-sm-12 estimate-ship-tax" id="infoCustomer_cart">
			<form method="post" class="form-horizontal">
			<table class="table">
				<thead>
					<tr>
						<th colspan="6">
							<span class="estimate-title">Thông tin khách hàng</span> 
						</th>
					</tr>
				</thead>
				<!-- <tfoot>
						<tr>
							<td colspan="6">
								<p class="text-center first" style="margin-left: 183px;">
									<button type="submit" class="btn btn-default first" style="color: #fff;">
										<strong>Tiếp tục</strong>
										<span style="font-size: 11px;">(Chọn hình thức nhận hàng)</span>
									</button>
								</p>
								<p style="margin-top: 15px;">Hoặc</p>
								<p class="text-center">
									<button type="submit" class="btn btn-default">
										<strong style="color: #337ab7">Đặt hàng luôn</strong>
										<span style="color: #656565;font-size: 11px;">Mototech shop sẽ gọi điện cho quý khách</span>
									</button>
								</p>
							</td>
						</tr>
						
					</tfoot> -->
				<tbody>
					<tr>
						<td colspan="6">
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
										<button type="submit" class="btn btn-primary" style="position: absolute; top: 10%; right: -20%;">Đặt hàng</button>
									</div>
									<!-- <div class="col-sm-4"> -->
										<!-- <br><br><br><br> -->
									<!-- </div> -->
								</div>
						  </form>
						</td>
					</tr>
				</tbody>
				<!-- /tbody --> 
			</table>
			<!-- /table --> 
			 </form>
		</div>
		<!-- /.estimate-ship-tax --> 
		
	</div>
	<!-- /.shopping-cart --> 
<!-- </div> -->
<!-- /.row -->
<?php 
$this->registerJsFile("@web/js/checkout.js", ['depends' => [yii\web\JqueryAsset::className()]]);