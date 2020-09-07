<?php 
    use yii\widgets\LinkPager;
    use yii\helpers\Url;
    use yii\helpers\Html;
    $product = $data['product'];
    $this->title = $product['title'];
    // $this->registerCssFile('@web/change.css');
?>
<section>
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
	    <?php if ($data['category']['parent']): ?>
	    	<li class="breadcrumb-item"><a href="<?= Url::to(['product/index', 'slug' => $data['category']['parent']['slug']]) ?>"><?= $data['category']['parent']['cateName'] ?></a></li>
	    <?php endif ?>
	    <li class="breadcrumb-item"><a href="<?= Url::to(['product/index', 'slug' => $data['category']['slug']]) ?>"><?= $data['category']['cateName'] ?></a></li>
	  </ol>
	</nav>
</section>
	<section class="shortcut">
		<div class="content">
			<div class="row">
				<?php if (!empty($data['product']['imageList'])): ?>
					<div class="col-lg-5 col-xl-5">
						<div id="owl-demo-product-detail" class="owl-carousel owl-theme">
							<?php foreach ($data['product']['imageList'] as $keyi => $imagepro): ?>
								<div class="item"><img id="img_<?= ($keyi==0) ? $product['id']:$product['id'].$keyi; ?>" class="img-shortcut" src="<?= $imagepro['image'] ?>" width="100%" alt="<?= $imagepro['alt'] ?>"></div>
							<?php endforeach ?>
						</div>
						<?php if (count($data['product']['imageList'])>1):  ?>
						<div id='carousel-custom-dots' class='owl-dots'> 
							<?php foreach ($data['product']['imageList'] as $key => $imagepro): ?>
								<button role="button" class="owl-dot <?= ($key==0)?'active':'' ?>"><img class="img-shortcut" src="<?= $imagepro['image'] ?>" alt="" width="40px"></button>
							<?php endforeach ?>
						</div>
						<?php endif ?>
					</div>
				<?php endif ?>
				<div class="col-lg-7 col-xl-7">
					<div class="row">
						<h1 class="col-md-12" id="txtPro_<?= $product['id'] ?>"><?= $product['pro_name'] ?></h1>
						<?php if (!empty($thuoctinh = $data['product']['thuoctinh'])): ?>
							<div class="attribute col-md-12">
								<ul>
									<?php foreach ($thuoctinh as $value): ?>
										<li><?= $value['name'].': '.$value['value'] ?></li>
									<?php endforeach ?>
								</ul>
							</div>
						<?php endif ?>
						<div class="desc col-md-12">
							<?= $product['short_introduction'] ?>
						</div>
						<?php if (!$data['versions'] || !isset($data['versions'])): ?>
						<div class="area col-md-12">
							<div class="area-price">
								<?php $today = date("Y-m-d"); if ($product['price_sales']=='' && $product['price']==''): ?>
									<span>Giá: Vui lòng liên hệ</span>
								<?php elseif ($product['start_sale']!='' && $product['end_sale']!='' && $today>=$product['start_sale'] && $today<=$product['end_sale'] && $product['price_sales'] < $product['price'] && $product['price_sales'] > 0): ?>
									Giá:  
									<span id="txtPrice_<?= $product['id'] ?>"> <?= number_format((int)$product['price_sales'], 0, ',', '.') ?><sup>đ</sup></span> 
									<span><i><del><?= number_format((int)$product['price'], 0, ',', '.') ?><sup>đ</sup></del></i></span>
								<?php else: ?>
										<span>Giá: 
										<span id="txtPrice_<?= $product['id'] ?>"> <?= number_format((int)$product['price'], 0, ',', '.') ?><sup>đ</sup></span> </span>
								<?php endif ?>
								<div class="price col-md-12">
									<?php if ($data['versions']): foreach ($data['versions'] as $vs => $version): ?>
										<a onclick="changeActivePrice(<?= $version['id'] ?>)" class="item <?= ($vs==0)?'active':'' ?>" href="javascrip:void(0)">
											<span><i class="iconmobile-opt"></i><?= $version['name'] ?></span>
											<strong><?= number_format((int)$version['price_sale_1'], 0, ',', '.') ?>₫</strong>
										</a>
									<?php endforeach;endif ?>
								</div>
							</div>
							<div class="row">
								<div class="qty col-md-3 col-sm-3">
									<input id="number" name="qty" value="1" type="number" min="1" class="form-control">
								</div>
								<div class="area-order col-md-9 col-sm-9">
									<button class="btn btn-primary" type="button" onclick="addCart(<?= $product['id'] ?>)"><i class="fas fa-shopping-cart"></i> Thêm vào giỏ hàng</button>
								</div>
							</div>
							<div class="row">
								<div class="views col-md-6 col-sm-6">Lượt xem: <?= $product['views'] ?></div>
							</div>
						</div>
					<?php endif ?>
				</div>
				</div>
			</div>
		</div>
	</section>
	<?php if ($data['versions']): ?>
	<section class="product-variation">
		<div class="row">
			<div class="col-lg-2 col-xl-2">Ngày</div>
			<div class="col-lg-2 col-xl-2">Tên</div>
			<div class="col-lg-2 col-xl-2" id="price-1">Giá 1</div>
			<div class="col-lg-2 col-xl-2" id="price-2">Giá 2</div>
			<div class="col-lg-2 col-xl-2" id="price-3">Giá 3</div>
			<div class="col-lg-2 col-xl-2"></div>
		</div>
		<?php foreach ($data['versions'] as $version): ?>
			<?php if ($version['date']>=date("Y-m-d")): ?>
			<div class="row">
				<div class="col-lg-2 col-xl-2" id="versions_date"><?= Yii::$app->formatter->asDate($version['date'], 'dd-MM-Y'); ?></div>
				<div class="col-lg-2 col-xl-2"><?= $version['name'] ?></div>
				<div class="col-lg-2 col-xl-2">
					<span id="txtPrice_<?= $version['id'] ?>">
						<?php if ($version['price_sale_1']>0): ?>
							<?= number_format((int)$version['price_sale_1'], 0, ',', '.') ?><sup>đ</sup>
							<i><del><?= number_format((int)$version['price_1'], 0, ',', '.') ?><sup>đ</sup></del></i>
						<?php else: ?>
							<?php if ($version['price_1']>0): ?>
								<i><?= number_format((int)$version['price_1'], 0, ',', '.') ?><sup>đ</sup></i>
							<?php else: ?>
								-
							<?php endif ?>
						<?php endif ?>
					</span>
				</div>
				<div class="col-lg-2 col-xl-2" id="price-1">
						<?php if ($version['price_2'] > 0): ?>
							<?= number_format((int)$version['price_2'], 0, ',', '.') ?>
						<?php else: ?>
							-							
						<?php endif ?>
					</div>
				<div class="col-lg-2 col-xl-2" id="price-2">
						<?php if ($version['price_3'] > 0): ?>
							<?= number_format((int)$version['price_3'], 0, ',', '.') ?>
						<?php else: ?>
							-
						<?php endif ?>
					</div>
				<div class="col-lg-2 col-xl-2">
					<a href="javascrip:void(0)" onclick="addCart(<?= $product['id'] ?>,<?= $version['id'] ?>)">Thêm vào giỏ hàng</a><!-- cho vào giỏ hàng -->
				</div>
			</div>
			<?php endif ?>
		<?php endforeach ?>
	</section>
	<?php endif ?>
	<section class="product-detail">
		<div class="row">
			<div class="col-lg-12 col-xl-12">
				<ul class="nav nav-tabs" id="myTab" role="tablist">
				  <li class="nav-item">
				    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Chi tiết</a>
				  </li>
				  <?php if ($product['tab2'] !=''): ?>
				  	<li class="nav-item">
				  		<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Hướng dẫn</a>
				  	</li>
				  <?php endif ?>
				  <?php if ($product['tab3'] !=''): ?>
				  	<li class="nav-item">
				  		<a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Chính sách</a>
				  	</li>
				  <?php endif ?>
				</ul>
				<div class="tab-content" id="myTabContent">
				  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab"><?= $product['content'] ?></div>
				  <?php if ($product['tab2'] !=''): ?>
				  	<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab"><?= $product['tab2'] ?></div>
				  <?php endif ?>
				  <?php if ($product['tab3'] !=''): ?>
				  	<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="profile-tab"><?= $product['tab3'] ?></div>
				  <?php endif ?>
				</div>
			</div>
		</div>
		<?php if (!empty($product['tagsAll'])): ?>
			<div class="row">
				<div class="after-post-tags">
					<div class="post-categories aretags">
						<?php foreach ($product['tagsAll'] as $tag): ?>
							<a class="btn btn-outline-secondary" href="<?= Url::to(['product/tags', 'slugTag'=>$tag['slugTag']],true) ?>" role="button"><?= $tag['value'] ?></a>
						<?php endforeach ?>
					</div>
				</div>
			</div>
		<?php endif ?>
	</section>
	<?php if ($data['productRelated']): ?>
		<section class="product-topic">
			<div class="row"><h2>Sản phẩm liên quan</h2></div>
			<div class="row">
				<div class="col-lg-12 col-xl-12">
					<?= frontend\widgets\products\productDetailWidget::widget(['data'=>$data['productRelated']]); ?>
				</div>
			</div>
		</section>
	<?php endif ?>
<?php if (isset($data['news'])): //dbg($data['news'])?>
	<section class="news-topic">
		<div class="row"><h2>Tin liên quan</h2></div>
		<div class="row">
			<div class="col-lg-12 col-xl-12">
				<ul style="clear: both;">
					<?php foreach ($data['news'] as $news): ?>
						<li><a href="<?= Url::to(['news/view', 'slugCate'=>$news['slugCate'], 'slug'=>$news['newSlug'],'idNew'=>$news['id']],true) ?>"><?= $news['name'] ?></a></li>
					<?php endforeach ?>
				</ul>
			</div>
		</div>
	</section>
<?php endif ?>
<?php if ($data['cungdanhmuc']): ?>
	<section class="product-more">
		<div class="row"><h2>Sản phẩm cùng chuyên mục</h2></div>
		<div class="row">
			<?php foreach ($data['cungdanhmuc'] as $dmuc): //dbg($dmuc)?>
			<div class="col-lg-3 col-xl-3">
				<div class="thumbnail">
					<a class="img" href="<?= Url::to(['product/view', 'slugCate'=>$dmuc['slugCate'], 'slug'=>$dmuc['slug']],true) ?>"><img src="<?= isset($dmuc['imageOne']['image']) ? $dmuc['imageOne']['image']:'/images/no-image.jpg'; ?>" width="100%" alt="<?= $dmuc['title'] ?>" class="img-thumbnail"></a>
					<div class="caption">
						<a class="title" href="<?= Url::to(['product/view', 'slugCate'=>$dmuc['slugCate'], 'slug'=>$dmuc['slug']],true) ?>"><h3><?= $dmuc['pro_name'] ?></h3></a>
						<?php if ($product['proVersionsOne']): ?>
							<div class="price">
								<span class="date"><?= Yii::$app->formatter->asDate($product['proVersionsOne']['date']) ?></span>
								<span class="name"><?= $product['proVersionsOne']['name'] ?></span>
								<?php if ($product['proVersionsOne']['price_1']>$product['proVersionsOne']['price_sale_1'] && $product['proVersionsOne']['price_sale_1'] >0): ?>
									<strong><?= Yii::$app->formatter->format($product['proVersionsOne']['price_sale_1'], ['decimal', 0]) ?><sup>đ</sup></strong>
									<span><del><?= Yii::$app->formatter->format($product['proVersionsOne']['price_1'], ['decimal', 0]) ?></del><sup>đ</sup></span>
								<?php else: ?>
									<span class="name"><strong><?= Yii::$app->formatter->format($product['proVersionsOne']['price_1'], ['decimal', 0]) ?><sup>đ</sup></strong></span>
								<?php endif ?>
							</div>
						<?php else: ?>
							<div class="price">
								<?php $today = date("Y-m-d"); if ($dmuc['price_sales']=='' && $dmuc['price']==''): ?>
								<span>Giá: Vui lòng liên hệ</span>
								<?php elseif ($dmuc['start_sale']!='' && $dmuc['end_sale']!='' && $today>=$dmuc['start_sale'] && $today<=$dmuc['end_sale'] && $dmuc['price_sales'] < $dmuc['price'] && $dmuc['price_sales'] > 0): ?>
									<strong id="txtPrice_<?= $dmuc['id'] ?>"> <?= number_format((int)$dmuc['price_sales'], 0, ',', '.') ?><sup>đ</sup></strong> 
									<span><i><del><?= number_format((int)$dmuc['price'], 0, ',', '.') ?><sup>đ</sup></del></i></span>
									<?php else: ?>
										<span>
											<strong id="txtPrice_<?= $dmuc['id'] ?>"> <?= number_format((int)$dmuc['price'], 0, ',', '.') ?><sup>đ</sup></strong> 
										</span>
									<?php endif ?>
								</div>
							<?php endif ?>
						<p class="attr"><?= $dmuc['short_introduction'] ?></p>
					</div>
				</div>
			</div>
			<?php endforeach ?>
		</div>
	</section>
<?php endif ?>
<?php if (!empty($data['related_albums'])): ?>
    <section class="product-more">
        <div class="row"><h2>Thư viên ảnh</h2></div>
        <div class="row">
            <?php foreach ($data['related_albums'] as $albums): //dbg($product)?>
            <div class="col-lg-3 col-xl-3">
                <div class="thumbnail">
                    <a class="img" href="<?= Url::to(['albums/view', 'slug'=>$albums['slug']],true) ?>"><img src="<?= isset($albums['oneImages']['image']) ? $albums['oneImages']['image']:'/images/no-image.jpg'; ?>" width="100%" alt="<?= $albums['title'] ?>" class="img-thumbnail"></a>
                    <div class="caption">
                        <a class="title" href="<?= Url::to(['albums/view', 'slug'=>$albums['slug']],true) ?>"><h3><?= $albums['name'] ?></h3></a>
                        <p class="attr"><?= $albums['short_description'] ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach ?>
        </div>
    </section>
<?php endif ?>

<?php if (!empty($data['related_downloads'])): ?>
	<section class="news-topic row">
		<h2>Tài liệu liên quan</h2>
			<div class="col-lg-12 col-xl-12">
				<ul>
					<?php foreach ($data['related_downloads'] as $keyd => $download): ?>
						<li> <?= $keyd+1 ?> : <?= $download['name'] ?> <a href="<?= Url::to(['downloads/view', 'slug'=>$download['link']],true) ?>"><i class="fas fa-download pull-right">  Tải</i></a></li>
					<?php endforeach ?>
				</ul>
			</div>
	</section>
<?php endif ?>
<style type="text/css">
	#owl-demo .item{
  background: #3fbf79;
  padding: 30px 0px;
  margin: 10px;
  color: #FFF;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  text-align: center;
}
.customNavigation{
  text-align: center;
}
/*//use styles below to disable ugly selection*/
.customNavigation a{
  -webkit-user-select: none;
  -khtml-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
}
</style>
<?php 
$this->registerJsFile("@web/js/product_view.js", ['depends' => [yii\web\JqueryAsset::className()]]);
?>