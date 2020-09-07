<?php use yii\helpers\Url; ?>
<?php if ($data['tags']): ?>
<li class="ttile">Có phải bạn muốn tìm:</li>
	<?php foreach ($data['tags'] as $value): ?>
		<?php if ($value['type'] == 'product'): ?>
			<li>
				<a class="" href="<?= Url::to(['product/tags', 'slugTag'=>$value['slugTag']],true) ?>" role="button">
					<img width="30" src="<?= $value['proOne']['image'] ?>" alt="">
					<?= $value['value'] ?>
				</a>
			</li>
		<?php endif ?>
	<?php endforeach ?>
<?php endif ?>
<?php if ($data['products']): ?>
<li class="ttile">Sản phẩm gợi ý:</li>
	<?php foreach ($data['products'] as $product): ?>
		<li>
			<a class="img" href="<?= Url::to(['product/view', 'slugCate'=>$product['slugCate'], 'slug'=>$product['slug']],true) ?>">
				<img width="30" src="<?= isset($product['imageOne']['image'])? $product['imageOne']['image']:'/images/no-image.jpg' ?>" width="100%" alt="<?= $product['title'] ?>" class="">
				<?= $product['pro_name'] ?>
			</a>
		</li>
	<?php endforeach ?>
<?php endif ?>