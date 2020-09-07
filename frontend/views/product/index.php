<?php 
use yii\widgets\LinkPager;
use yii\helpers\Url;
$this->title = $category['title'];
 ?>
<section>
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
	    <li class="breadcrumb-item"><a href="<?= Url::to(['product/index', 'slug' => $category['slug']]) ?>"><?= $category['cateName'] ?></a></li>
	  </ol>
	</nav>
</section>
<section class="filter">
	<h3>Lọc sản phẩm</h3>
	<?php
	$attribute = array_unique(array_column($data['attribute'],'name'));
	// dbg($attribute);
	 foreach ($attribute as $attri): ?>
  <div class="dropdown">
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"> <?= $attri ?> </button>
    <div class="dropdown-menu">
    	<?php foreach ($data['attribute'] as $loc):  if($loc['name'] != $attri) continue;//pr($loc);?>
    		<a class="dropdown-item" href="#<?= $category['slug'] ?>" data-id="<?= $loc['id'] ?>">
    			<i class="icontgdd-checkbox"></i>
    			<?= $loc['value'] ?>
    		</a>
    	<?php endforeach ?>
    </div>
  </div>
	<?php endforeach ?>
</section>

<div class="clearfix"></div>
<div class="row">
<section class="product-grid-1">
	<div class="row">
		<div class="description col-sm-12">
			<?= $category['short_introduction'] ?>
		</div>
		<div class="container-fluid">
		<div class="row" id="listProductData">
		<?php if ($data): ?>
			<?php foreach ($data['products'] as $product): //pr($product->danhmuc)?>
				<div class="col-lg-3 col-xl-3">
					<div class="thumbnail">
						<a class="img" href="<?= Url::to(['product/view', 'slugCate'=>$product->danhmuc->slug, 'slug'=>$product->slug],true) ?>"><img src="<?= isset($product->imageOne)? $product->imageOne->image:'/images/no-image.jpg' ?>" width="100%" alt="<?= $product->title ?>" class="img-thumbnail"></a>
						<div class="caption">
							<a class="title" href="<?= Url::to(['product/view', 'slugCate'=>$product->danhmuc->slug, 'slug'=>$product->slug],true) ?>"><h3><?= $product->pro_name ?></h3></a>
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
		</div>
		</div>
		<div class="content col-sm-12">
			<?= $category['content'] ?>
		</div>
		<div class="col-md-12" id="phantrang">
			<nav aria-label="Page navigation">
				<?= LinkPager::widget([
					'pagination' => $data['pages'],
					'hideOnSinglePage' => true,
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
					// 'listOptions' => ['class' => ['pagination']],
					// 'disableCurrentPageButton' => false
					// 'registerLinkTags' => false
					'disabledPageCssClass' => 'disabled',
				]);
				?>
			</nav>
		</div>
	</div>
</section>
</div>
<style type="text/css">
	.filter .dropdown {
		float: left; 
	}
</style>

<?php 
$this->registerJsFile("@web/js/locsanpham.min.js", ['depends' => [yii\web\JqueryAsset::className()]]);
?>