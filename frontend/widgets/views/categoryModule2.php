<?php Use yii\helpers\Url; ?>
<section class="nav">
	<h2><a href="<?= ($data['type_module']=='product')? Url::to(['product/danhsach', 'slugCate' => $data['CateSlug']]): Url::to(['news/index', 'slugCate' => $data['newSlug']]); ?>"><?= $data['name'] ?></a></h2>
	<nav>
		<ul class="list-group list-group-flush">
			<li class="list-group-item">
				<div id="li-div-1">
					<a href="#">Điện thoại</a>
					<a id="li-ic-1" href="javascript:void(0)"><i class="fas fa-plus"></i></a>
				</div>
				<ul id="ul2" class="ul2">
					<li class="li2"><a href="#">Apple</a>
						<ul class="ul3">
							<li class="li3"><a href="#">Sản phẩm mới</a></li>
							<li class="li3"><a href="#">Sản phẩm cũ</a></li>
						</ul>
					</li>
					<li class="li2"><a href="#">Samsung</a></li>
					<li class="li2"><a href="#">Nokia</a></li>
				</ul>
			</li>
			<li class="list-group-item"><a href="#">Máy ảnh</a></li>
			<li class="list-group-item">
				<div id="li-div-2">
					<a href="#">Phụ kiện</a>
					<a id="li-ic-2" href="javascript:void(0)"><i class="fas fa-plus"></i></a>
				</div>
				<ul id="ul3" class="ul2">
					<li class="li2"><a href="#">Apple</a></li>
					<li class="li2"><a href="#">Samsung</a></li>
					<li class="li2"><a href="#">Nokia</a></li>
				</ul>
			</li>
		</ul>
	</nav>
</section><!-- /.nav -->