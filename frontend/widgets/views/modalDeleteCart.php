<?php use yii\helpers\Url;use yii\helpers\Html; ?>
<div class="modal fade bd-example-modal-lg"  id="deleteshopping">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Bạn có muốn xóa sản phẩm khỏi giỏ hàng ?</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				
			</div>
			<div class="modal-body" style="overflow: hidden;">
				<div class="row">
					<div class="col-md-3">
						<img src="" id="imgPreviewdel" alt="" width="60%">
					</div>
					<div class="col-md-9">
						<h4><span id="txtNameProductdel"></span></h4>
						<!-- <p>Giá sản phẩm: <i><span id="txtpricedel"></span></i> đ</p> -->
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button id="modal_delete" type="button" data-id="" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-trash"></span>Xóa sản phẩm</button>
				<!-- <button id="modal_delete" type="button" data-id="" class="btn btn-danger" data-dismiss="modal" onclick="deleteItem(0)"><span class="glyphicon glyphicon-trash"></span>Xóa sản phẩm</button> -->
				<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
