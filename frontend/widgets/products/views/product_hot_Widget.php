<?php Use yii\helpers\Url; use yii\widgets\LinkPager;
 if (!empty($listProduct)): ?>
    <section class="module-navicat hot">
    	<div class="header">
    		<h2>Sản phẩm nổi bật</h2>
    		<div class="viewallcat d-none d-sm-block">
    			<a href="<?= Url::to(['product/hotproduct']) ?>">Xem tất cả <span></span> sản phẩm</a>
    		</div>
    	</div>
    	<div class="owl-carousel owl-theme homepromo auto">
			<?php foreach ($listProduct as $product): $discount=false; ?>
				<div class="item">
					<a href="<?= Url::to(['product/view', 'slugCate' => $product['slugCate'], 'slug' => $product['slug']]) ?>">
						<img src="<?= isset($product['image']) ? $product['image']: '/images/no-image.jpg' ?>" width="100%" alt="<?= isset($product['imageOne']['image']) ? $product['imageOne']['title']: $product['title'] ?>">
						<h3><?= $product['pro_name'] ?></h3>
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

							<div class="price">
								<?php $today = date("Y-m-d"); if($product['start_sale']!='' && $product['end_sale']!='' && $today>=$product['start_sale'] && $today<=$product['end_sale'] && $product['price_sales']>0 && $product['price_sales'] < $product['price']): $discount=true ?>
									<strong><?= Yii::$app->formatter->format($product['price_sales'], ['decimal', 0]) ?><sup>₫</sup></strong>
									<span><del><?= Yii::$app->formatter->format($product['price'], ['decimal', 0]) ?></del><sup>₫</sup></span>
								<?php elseif ($product['price']>0): ?>
									<strong><?= Yii::$app->formatter->format($product['price'], ['decimal', 0]) ?><sup>₫</sup></strong>
								<?php endif ?>
							</div>
						<?php endif ?>

						<?php if ($discount): ?>
							<label class="discount">GIẢM <?= Yii::$app->formatter->format(($product['price']-$product['price_sales'])/$product['price'], ['percent', 0]); ?></label>
						<?php endif ?>
					</a>
					<?= $product['short_introduction'] ?>
				</div>
			<?php endforeach ?>
    	</div>
    </section>
<?php endif ?>