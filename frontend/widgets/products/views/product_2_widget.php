<?php Use yii\helpers\Url; ?>
<section class="module-navicat list">
	<div class="header">
		<h2><?= $data['name'] ?></h2>
		<div class="viewallcat d-none d-sm-block">
			<?php if (!empty($data['childrents'])): ?>
				<?php foreach ($data['childrents'] as $childrent): ?>
					<?php if ($childrent['type_module']=='product' && !empty($childrent['category'])): ?>
						<a href="<?= Url::to(['product/index','slug' => $childrent['category']['slug']]) ?>"><?= $childrent['name'] ?></a>
					<?php else: ?>
						<?= $childrent['content'] ?>
					<?php endif ?>
				<?php endforeach ?>
			<?php endif ?>
			<a href="<?= Url::to(['product/index','slug' => $data['slugCate']]) ?>">Xem tất cả <span></span> sản phẩm</a>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="product-list">
		<div class="row">
			<div class="col-lg-12 col-xl-12 des">
				<?= $data['content'] ?>
			</div>
			<?php if ($listProduct): ?>
				<?php foreach ($listProduct as $product)://dbg($product)?>
					<div class="col-lg-3 col-xl-3">
						<div class="thumbnail">
							<a class="img" href="<?= Url::to(['product/view', 'slugCate' => $product['slugCate'], 'slug' => $product['slug']]) ?>">
								<img src="<?= isset($product['imageOne']['image']) ? $product['imageOne']['image']: '/images/no-image.jpg' ?>" width="100%" alt="<?= isset($product['imageOne']['image']) ? $product['imageOne']['title']: $product['title'] ?>" class="img-thumbnail">
							</a>
							<div class="caption">
								<a class="title" href="<?= Url::to(['product/view', 'slugCate' => $product['slugCate'], 'slug' => $product['slug']]) ?>"><h3><?= $product['pro_name'] ?></h3></a>
								
								<?php if ($product['oneAttribute']): ?>
									<p><?= $product['oneAttribute']['name'].' : '.$product['oneAttribute']['value'] ?></p>
								<?php endif ?>
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
									<p class="price">
										<?php $today = date("Y-m-d"); if($product['start_sale']!='' && $product['end_sale']!='' && $today>=$product['start_sale'] && $today<=$product['end_sale'] && $product['price_sales'] < $product['price'] && $product['price_sales'] > 0): ?>
										<strong><?= Yii::$app->formatter->format($product['price_sales'], ['decimal', 0]) ?><sup>đ</sup></strong> 
										<span><del><?= Yii::$app->formatter->format($product['price'], ['decimal', 0]) ?></del><sup>đ</sup></span>
										<?php elseif ($product['price']>0): ?>
											<strong><?= Yii::$app->formatter->format($product['price'], ['decimal', 0]) ?><sup>đ</sup></strong>
										<?php endif ?>
									</p>
								<?php endif ?>
								<?= $product['short_introduction'] ?>
							</div>
						</div>
					</div>
				<?php endforeach ?>
			<?php endif ?>
		</div>
	</div>
</section>