<?php Use yii\helpers\Url; ?>
<div class="module-navicat products">
	<div class="header">
		<h2><?= $data['name'] ?></h2>
		<div class="viewallcat d-none d-sm-block">
			<?php foreach ($data['childrens'] as $value): ?>
				<a href="<?= Url::to(['product/index', 'slug' => $data['CateSlug']]) ?>"><?= $value['name'] ?></a>
			<?php endforeach ?>
		</div>
	</div>
	<div class="owl-carousel owl-theme homepromo">
		<?php if ($listProduct): ?>
			<?php foreach ($listProduct as $product): dbg($product)?>
				<div class="item">
					<a href="<?= Url::to(['product/index', 'slug' => $product['slug']]) ?>">
						<img src="<?= $product['image'] ?>" alt="<?= $product['title'] ?>">
						<h3><?= $product['pro_name'] ?></h3>
						<div class="price">
							<?php $today = date("Y-m-d"); if ($today>0): ?>
								
							<?php else: ?>
								
							<?php endif ?>
							<?php if ($product['price_sales']>0): ?>
								<strong><?= Yii::$app->formatter->format($product['price_sales'], ['decimal', 2]) ?>₫</strong>
							<?php endif ?>
							<?php if ($product['price']>0): ?>
								<span><?= Yii::$app->formatter->format($product['price'], ['decimal', 2]) ?>₫</span>
							<?php endif ?>
						</div>
						<div class="promo noimage">
							<p> Tai nghe Level U Flex</p>
						</div>
						<label class="discount">GIẢM <?= Yii::$app->formatter->format(($product['price']-$product['price_sales'])/$product['price'], ['percent', 2]); ?>%</label>
					</a>
				</div>
			<?php endforeach ?>
		<?php endif ?>
		
	</div>
</div>
<button type="button" class="btn btn-default"><a class="button secondary play" href="javascript:void(0)">Play</a></button>
<button type="button" class="btn btn-default"><a class="button secondary stop" href="javascript:void(0)">Stop</a></button>