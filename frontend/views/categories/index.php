<?php
use yii\widgets\LinkPager;
use frontend\widgets\index\sectionHero;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
$this->title = $data['seo']['title'];
?>


<!-- ========================================== SECTION – HERO ========================================= -->
<?= sectionHero::widget() ?>
	<h1><?= $data['seo']['title'] ?></h1>
<!-- ========================================= SECTION – HERO : END ========================================= -->
<div class="clearfix filters-container m-t-10">
	<div class="row">
		<div class="col col-sm-6 col-md-2">
			<div class="filter-tabs">
				<ul id="filter-tabs" class="nav nav-tabs nav-tab-box nav-tab-fa-icon">
					<li class="active">
						<a data-toggle="tab" href="#grid-container"><i class="icon fa fa-th-large"></i>Grid</a>
					</li>
					<li><a data-toggle="tab" href="#list-container"><i class="icon fa fa-th-list"></i>List</a></li>
				</ul>
			</div>
			<!-- /.filter-tabs -->
		</div>
		<!-- /.col -->
		<div class="col col-sm-12 col-md-6">
			<div class="col col-sm-3 col-md-6 no-padding">
				<div class="lbl-cnt">
					<span class="lbl">Sắp xếp</span>
					<div class="fld inline">
						<div class="dropdown dropdown-small dropdown-med dropdown-white inline">
							<button data-toggle="dropdown" type="button" class="btn dropdown-toggle">
								Position <span class="caret"></span>
							</button>
							<ul role="menu" class="dropdown-menu">
								<li role="presentation"><a href="#">position</a></li>
								<li role="presentation"><a href="#">Price:Lowest first</a></li>
								<li role="presentation"><a href="#">Price:HIghest first</a></li>
								<li role="presentation"><a href="#">Product Name:A to Z</a></li>
							</ul>
						</div>
					</div>
					<!-- /.fld -->
				</div>
				<!-- /.lbl-cnt -->
			</div>
			<!-- /.col -->
			<div class="col col-sm-3 col-md-6 no-padding">
				<div class="lbl-cnt">
					<span class="lbl">Số sản phẩm</span>
					<div class="fld inline">
						<div class="dropdown dropdown-small dropdown-med dropdown-white inline">
							<button data-toggle="dropdown" type="button" class="btn dropdown-toggle">
								1 <span class="caret"></span>
							</button>
							<ul role="menu" class="dropdown-menu">
								<li role="presentation"><a href="#">1</a></li>
								<li role="presentation"><a href="#">2</a></li>
								<li role="presentation"><a href="#">3</a></li>
								<li role="presentation"><a href="#">4</a></li>
								<li role="presentation"><a href="#">5</a></li>
								<li role="presentation"><a href="#">6</a></li>
								<li role="presentation"><a href="#">7</a></li>
								<li role="presentation"><a href="#">8</a></li>
								<li role="presentation"><a href="#">9</a></li>
								<li role="presentation"><a href="#">10</a></li>
							</ul>
						</div>
					</div>
					<!-- /.fld -->
				</div>
				<!-- /.lbl-cnt -->
			</div>
			<!-- /.col -->
		</div>
		<!-- /.col -->
		<div class="col col-sm-6 col-md-4 text-right">

			<div class="pagination-container">
				<?php 
				if ($data['pages']->pageCount  > 1) {

					echo LinkPager::widget([
						'pagination' => $data['pages'],
						'firstPageLabel' => 'First',
						'lastPageLabel' => 'Last',
						'prevPageLabel' => '<i class="fa fa-angle-left"></i>',
						'nextPageLabel' => '<i class="fa fa-angle-right"></i>',
						'maxButtonCount' => 4,
						'options'=>['class'=>'list-inline list-unstyled'],
					]);
				}
				?>
				<!-- <ul class="list-inline list-unstyled">
					<li class="prev"><a href="#"><i class="fa fa-angle-left"></i></a></li>
					<li><a href="#">1</a></li>
					<li class="active"><a href="#">2</a></li>
					<li><a href="#">3</a></li>
					<li><a href="#">4</a></li>
					<li class="next"><a href="#"><i class="fa fa-angle-right"></i></a></li>
				</ul> -->
				<!-- /.list-inline -->
			</div>
			<!-- /.pagination-container -->		
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->
</div>
<div class="search-result-container">

	<div class="clearfix"></div>
	<div id="myTabContent" class="tab-content category-list">
		<div class="tab-pane active" id="grid-container">
			<div class="category-product">
				<div class="row">
					<?php foreach ($data['dataProduct'] as $key => $value): $imagePro = ($value['image']=='')? 'images/products/p5.jpg': $value['image'];
						if (!empty($value['protype'])) {
							$typepro = ArrayHelper::map($value['protype'],'idtype','product_type_id');
							$random_keys=array_rand($typepro);
							$typepro = $typepro[$random_keys];
						}
						?>
					<div class="col-sm-6 col-md-4 wow fadeInUp">
						<div class="products">
							<div class="product">
								<div class="product-image">
									<div class="image">
										<a href="<?= Url::to(['product/index', 'slug'=>$value['slug']],true) ?>"><img  src="<?= Yii::$app->homeUrl.$imagePro ?>" alt=""></a>
									</div>
									<!-- /.image -->
									<?php if (isset($typepro)):?>
										<div class="tag <?= $productType[$typepro] ?>"><span><?php echo $productType[$typepro];unset($typepro); ?></span></div>
									<?php endif ?>			
								</div>
								<!-- /.product-image -->
								<div class="product-info text-left">
									<h3 class="name"><a href="<?= Url::to(['product/index', 'slug'=>$value['slug']],true) ?>"><?= $value['pro_name'] ?></a></h3>
									<!-- <div class="rating rateit-small"></div> -->
									<div class="description"></div>
									<div class="product-price">
										<?php if ($value['price_sales'] !=''): ?>
											<span class="price"> <?= Yii::$app->formatter->asDecimal($value['price_sales']) ?>       </span>
										<?php endif ?>
										<?php if ($value['price'] !=''): ?>
											<span class="price-before-discount"><?= Yii::$app->formatter->asDecimal($value['price']) ?></span>
										<?php endif ?>
									</div>
									<!-- /.product-price -->
								</div>
								<!-- /.product-info -->
								<div class="cart clearfix animate-effect">
									<div class="action">
										<ul class="list-unstyled">
											<li class="add-cart-button btn-group">
												<button class="btn btn-primary icon" data-toggle="dropdown" type="button" onclick="addCart(<?= $value['id'] ?>)">
													<i class="fa fa-shopping-cart"></i>
												</button>
												<button class="btn btn-primary cart-btn" type="button">Thêm vào giỏ hàng</button>
											</li>
											<li class="lnk wishlist">
												<a class="add-to-cart" href="detail.html" title="Wishlist">
													<i class="icon fa fa-heart"></i>
												</a>
											</li>
											<li class="lnk">
												<a class="add-to-cart" href="detail.html" title="Compare">
													<i class="fa fa-signal"></i>
												</a>
											</li>
										</ul>
									</div>
									<!-- /.action -->
								</div>
								<!-- /.cart -->
							</div>
							<!-- /.product -->
						</div>
						<!-- /.products -->
					</div>
					<!-- /.item -->
					<?php if (($key+1)%3==0): ?>
						<div class="clearfix"></div>
					<?php endif ?>
					<?php endforeach ?>
					
				</div>
				<!-- /.row -->
			</div>
			<!-- /.category-product -->
		</div>
		<!-- /.tab-pane -->
		<div class="tab-pane"  id="list-container">
			<div class="category-product">
				<?php foreach ($data['dataProduct'] as $key => $value): $imagePro = ($value['image']=='')? 'images/products/p5.jpg': $value['image'];
					if (!empty($value['protype'])) {
						$typepro = ArrayHelper::map($value['protype'],'idtype','product_type_id');
						$random_keys=array_rand($typepro);
						$typepro = $typepro[$random_keys];
					}
					?>
				<div class="category-product-inner wow fadeInUp">
					<div class="products">
						<div class="product-list product">
							<div class="row product-list-row">
								<div class="col col-sm-4 col-lg-4">
									<div class="product-image">
										<div class="image">
											<a href="<?= Url::to(['product/index', 'slug'=>$value['slug']],true) ?>">
											<img src="<?= Yii::$app->homeUrl.$imagePro ?>" alt="<?= $value['title'] ?>">
											</a>
										</div>
									</div>
									<!-- /.product-image -->
								</div>
								<!-- /.col -->
								<div class="col col-sm-8 col-lg-8">
									<div class="product-info">
										<h3 class="name"><a href="<?= Url::to(['product/index', 'slug'=>$value['slug']],true) ?>"><?= $value['pro_name'] ?></a></h3>
										<div class="rating rateit-small"></div>
										<div class="product-price">	
											<?php if ($value['price_sales'] !=''): ?>
												<span class="price"> <?= Yii::$app->formatter->asDecimal($value['price_sales']) ?>       </span>
											<?php endif ?>
											<?php if ($value['price'] !=''): ?>
												<span class="price-before-discount"><?= Yii::$app->formatter->asDecimal($value['price']) ?></span>
											<?php endif ?>
										</div>
										<!-- /.product-price -->
										<div class="description m-t-10"><?= $value['short_introduction'] ?></div>
										<div class="cart clearfix animate-effect">
											<div class="action">
												<ul class="list-unstyled">
													<li class="add-cart-button btn-group">
														<button class="btn btn-primary icon" data-toggle="dropdown" type="button">
															<i class="fa fa-shopping-cart"></i>													
														</button>
														<button class="btn btn-primary cart-btn" type="button">Add to cart</button>
													</li>
													<li class="lnk wishlist">
														<a class="add-to-cart" href="detail.html" title="Wishlist">
															<i class="icon fa fa-heart"></i>
														</a>
													</li>
													<li class="lnk">
														<a class="add-to-cart" href="detail.html" title="Compare">
															<i class="fa fa-signal"></i>
														</a>
													</li>
												</ul>
											</div>
											<!-- /.action -->
										</div>
										<!-- /.cart -->
									</div>
									<!-- /.product-info -->	
								</div>
								<!-- /.col -->
							</div>
							<!-- /.product-list-row -->
							<?php if (isset($typepro)):?>
								<div class="tag <?= $productType[$typepro] ?>"><span><?php echo $productType[$typepro];unset($typepro); ?></span></div>
							<?php endif ?>
						</div>
						<!-- /.product-list -->
					</div>
					<!-- /.products -->
				</div>
				<!-- /.category-product-inner -->
				<?php endforeach ?>
			</div>
			<!-- /.category-product -->
		</div>
		<!-- /.tab-pane #list-container -->
	</div>
	<!-- /.tab-content -->
	<?php if ($data['pages']->pageCount  > 1): ?>
		
	
	<div class="clearfix filters-container">
		<div class="text-right">
			<div class="pagination-container">
				<?= LinkPager::widget([
						'pagination' => $data['pages'],
						'firstPageLabel' => 'First',
						'lastPageLabel' => 'Last',
						'prevPageLabel' => '<i class="fa fa-angle-left"></i>',
						'nextPageLabel' => '<i class="fa fa-angle-right"></i>',
						'maxButtonCount' => 4,
						'options'=>['class'=>'list-inline list-unstyled'],
					]);
				?>
				<!-- /.list-inline -->
			</div>
			<!-- /.pagination-container -->						    
		</div>
		<!-- /.text-right -->
	</div>
	<!-- /.filters-container -->
	<?php endif ?>
</div>
<!-- /.search-result-container -->