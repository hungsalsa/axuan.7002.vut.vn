<?php Use yii\helpers\Url; ?>
<div class="module-navicat relatedness">
	<div class="owl-carousel owl-theme homepromo stop">
		<?php foreach ($data as $product): //dbg($product)?>
			<div class="item">
				<a href="<?= Url::to(['product/view', 'slugCate' => $product['slugCate'], 'slug' => $product['slug']]) ?>">
					<img src="<?= isset($product['imageOne']['image']) ? $product['imageOne']['image']:'/images/no-image.jpg' ?>" alt="<?= $product['title'] ?>">
					<h3><?= $product['pro_name'] ?></h3>
					
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
							<?php $today = date("Y-m-d"); if ($product['price_sales']=='' && $product['price']==''): ?>
							<span>Giá: Liên hệ</span>
							<?php elseif ($product['start_sale']!='' && $product['end_sale']!='' && $today>=$product['start_sale'] && $today<=$product['end_sale'] && $product['price_sales'] < $product['price'] && $product['price_sales'] > 0): ?>

								<strong id="txtPrice_<?= $product['id'] ?>"> <?= number_format((int)$product['price_sales'], 0, ',', '.') ?><sup>đ</sup></strong> 
								<span><i><del><?= number_format((int)$product['price'], 0, ',', '.') ?><sup>đ</sup></del></i></span>

								<?php else: ?>

									<strong id="txtPrice_<?= $product['id'] ?>"> <?= number_format((int)$product['price'], 0, ',', '.') ?><sup>đ</sup></strong> 
									
								<?php endif ?>
							</div>
							<?php if ($product['start_sale']!='' && $product['end_sale']!='' && $product['start_sale']<=$today && $today <= $product['end_sale']): ?>
						<label class="discount">GIẢM <?= Yii::$app->formatter->format(($product['price']-$product['price_sales'])/$product['price'], ['percent', 0]); ?></label>
					<?php endif ?>
				<?php endif ?>
				</a>
			</div>
		<?php endforeach ?>
	</div>
</div>