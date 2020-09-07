<?php use yii\helpers\Url; if ($data): ?>
	<?php foreach ($data as $product): //pr($product->proVersionsOne->name)?>
		<div class="col-lg-3 col-xl-3">
			<div class="thumbnail">
				<a class="img" href="<?= Url::to(['product/view', 'slugCate'=>$category['slug'], 'slug'=>$product->slug],true) ?>"><img src="<?= isset($product->imageOne)? $product->imageOne->image:'/images/no-image.jpg' ?>" width="100%" alt="<?= $product->title ?>" class="img-thumbnail"></a>
				<div class="caption">
					<a class="title" href="<?= Url::to(['product/view', 'slugCate'=>$category['slug'], 'slug'=>$product->slug],true) ?>"><h3><?= $product->pro_name ?></h3></a>
					<?php if (!isset($product->proVersionsOne['name'])): ?>
						<p class="price">
							<?php $today = date("Y-m-d"); if($product->start_sale !='' && $product->end_sale !='' && $today>=$product->start_sale && $today<=$product->end_sale && $product->price_sales < $product->price && $product->price_sales > 0): ?>
							<strong><?= Yii::$app->formatter->format($product->price_sales, ['decimal', 0]) ?><sup>đ</sup></strong> 
							<span><del><?= Yii::$app->formatter->format($product->price, ['decimal', 0]) ?><sup>đ</sup></del></span>
							<?php else: ?>
								<?php if ($product->price>0): ?>
									<strong><?= Yii::$app->formatter->format($product->price, ['decimal', 0]) ?><sup>đ</sup></strong> 
								<?php endif ?>
							<?php endif ?>
						</p>
					<?php endif ?>
					<p class="desc"><?= $product->short_introduction ?></p>
				</div>
			</div>
		</div>
	<?php endforeach ?>
	<?php endif ?>