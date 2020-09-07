<?php 
use yii\widgets\LinkPager;
use yii\helpers\Url;
 ?>
<section>
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="#">Sản phẩm</a></li>
	    <li class="breadcrumb-item"><a href="#">Điện thoại</a></li>
	    <li class="breadcrumb-item"><a href="#">Apple</a></li>
	  </ol>
	</nav>
</section>

<section class="custom"><!-- KIỂU TỰ TẠO -->
	<p>KIỂU TỰ TẠO => Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat pariatur, voluptate! Ea ex rerum.</p>
</section><!-- /.custom -->

<section class="product-grid-1 1">
	<div class="row">
		<?php if ($data['listproduct']): ?>
			<?php foreach ($data['listproduct'] as $product): ?>
				
				<div class="col-lg-3 col-xl-3">
					<div class="thumbnail">
						<a class="img" href="<?= Url::to(['product/index', 'slug'=>$product['slug']],true) ?>"><img src="<?= Yii::$app->homeUrl.$product['image'] ?>" width="100%" alt="<?= $product['title'] ?>" class="img-thumbnail"></a>
						<div class="caption">
							<a class="title" href="<?= Url::to(['product/index', 'slug'=>$product['slug']],true) ?>"><h3><?= $product['pro_name'] ?></h3></a>
							<p class="price"><span><?= $product['price_sales'] ?><sup>đ</sup></span> <span><del><?= $product['price'] ?><sup>đ1</sup></del></span></p>
							<p class="desc"><?= $product['short_introduction'] ?></p>
						</div>
					</div>
				</div>
			<?php endforeach ?>
		<?php endif ?>

		<div class="col-md-12">
			<nav aria-label="Page navigation">
				<?= LinkPager::widget([
					'pagination' => $data['pages'],
					// 'hideOnSinglePage' => true,
					'firstPageLabel'=>'|<',
					'lastPageLabel'=>'>|',
					'prevPageLabel'=>'<<',
					'nextPageLabel'=>'>>',
					'maxButtonCount'=>3,
                        // 'linkAttributes'=>['class' => 'page-link'],
                        // 'route' => 'article/index'
                        // 'pageParam' => 'page',
					'options' => ['class' => 'pagination justify-content-end'],
					'linkContainerOptions' => ['class' => 'page-item'],
					'linkOptions' => ['class' => 'page-link'],
					// 'listOptions' => ['class' => ['pagination']]
					// 'disableCurrentPageButton' => false
					// 'registerLinkTags' => false
					'disabledPageCssClass' => 'disabled',

				]);
				?>
			</nav>
		</div>

	</div>
</section><!-- /.product-grid-1 -->
<section class="custom">
	<!-- KIỂU TỰ TẠO 
	Có 2 cách hiển thị:
	1. cho hiển thị trang 1
	2. hoặc cho hiển thị tất cả các trang
	-->
	<p>KIỂU TỰ TẠO => Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat pariatur, voluptate! Ea ex rerum.</p>
</section><!-- /.custom -->