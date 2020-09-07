<?php Use yii\helpers\Url; ?>
<div class="module-navicat">
	<div class="header">
		<h2><?= $data['name'] ?></h2>
		<div class="viewallcat d-none d-sm-block">
			<?php foreach ($data['childrens'] as $value): ?>
				<a href="<?= Url::to(['product/danhsach', 'slugCate' => $data['CateSlug']]) ?>"><?= $value['name'] ?></a>
			<?php endforeach ?>
		</div>
	</div>
	<div class="owl-carousel owl-theme homepromo">
		<?php if ($listProduct): ?>
			<?php foreach ($listProduct as $product): ?>
				<div class="item">
					<a href="<?= Url::to(['product/index', 'slug' => $product['slug']]) ?>">
						<img src="<?= Yii::$app->homeUrl.$product['image'] ?>" alt="<?= $product['title'] ?>">
						<h3><?= $product['pro_name'] ?></h3>
						<div class="price">
							<strong><?= Yii::$app->formatter->format($product['price_sales'], ['decimal', 2]) ?>₫</strong>
							<span><?= Yii::$app->formatter->format($product['price'], ['decimal', 2]) ?>₫</span>
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

