<?php 
use yii\widgets\LinkPager;
use yii\helpers\Url;
$this->title = 'dadada';
 ?>
<section>
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
	    <!-- <li class="breadcrumb-item"><a href="#">Apple</a></li> -->
	  </ol>
	</nav>
</section>

<section class="product-grid-1">
	<div class="row">
		
		<?php if ($data): ?>
			<?php foreach ($data as $product): ?>
				
				<div class="col-lg-3 col-xl-3">
					<div class="thumbnail">
						<a class="img" href="<?= Url::to(['product/view', 'slugCate'=>$product['slugCate'], 'slug'=>$product['slug']],true) ?>"><img src="<?= isset($product['imageOne']['image']) ? $product['imageOne']['image']:'/images/no-image.jpg' ?>" width="100%" alt="<?= $product['title'] ?>" class="img-thumbnail"></a>
						<div class="caption">
							<a class="title" href="<?= Url::to(['product/view', 'slugCate'=>$product['slugCate'], 'slug'=>$product['slug']],true) ?>"><h3><?= $product['pro_name'] ?></h3></a>
							<p class="price">
								<?php $today = date("Y-m-d"); if($product['start_sale'] !='' && $product['end_sale'] !='' && $today>=$product['start_sale']  && $today<=$product['end_sale']  && $product['price_sales']  < $product['price']  && $product['price_sales']  > 0): ?>

								<span><?= Yii::$app->formatter->format($product['price_sales'] , ['decimal', 0]) ?><sup>đ</sup></span> <span><del><?= Yii::$app->formatter->format($product['price'] , ['decimal', 0]) ?><sup>đ</sup></del></span>

								<?php else: ?>
									<?php if ($product['price'] >0): ?>
										<span><?= Yii::$app->formatter->format($product['price'] , ['decimal', 0]) ?><sup>đ</sup></span> 
									<?php endif ?>
								<?php endif ?>

							</p>
							<p class="desc"><?= $product['short_introduction']  ?></p>
						</div>
					</div>
				</div>
			<?php endforeach ?>
		<?php endif ?>

		

		<div class="col-md-12">
			<nav aria-label="Page navigation">
				<?php // LinkPager::widget([
				// 	'pagination' => $data['pages'],
				// 	// 'hideOnSinglePage' => true,
				// 	'firstPageLabel'=>'|<',
				// 	'lastPageLabel'=>'>|',
				// 	'prevPageLabel'=>'<<',
				// 	'nextPageLabel'=>'>>',
				// 	'maxButtonCount'=>3,
    //                     // 'linkAttributes'=>['class' => 'page-link'],
    //                     // 'route' => 'article/index'
    //                     // 'pageParam' => 'page',
				// 	'options' => ['class' => 'pagination justify-content-end'],
				// 	'linkContainerOptions' => ['class' => 'page-item'],
				// 	'linkOptions' => ['class' => 'page-link'],
				// 	// 'listOptions' => ['class' => ['pagination']]
				// 	// 'disableCurrentPageButton' => false
				// 	// 'registerLinkTags' => false
				// 	'disabledPageCssClass' => 'disabled',

				// ]);
				?>
			</nav>
		</div>

	</div>
</section><!-- /.product-grid-1 -->