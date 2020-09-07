<?php Use yii\helpers\Url; ?>
<section class="nav">
	<h2>
		<a href="<?= ($data['type_module']=='product' && $data['cate_slug'] !='')? Url::to(['product/danhsach', 'slugCate' => $productCategory[$data['cate_slug']]]): Url::to(['news/index', 'slugCate' => $data['cate_slug']]); ?>"><?= $data['name'] ?></a></h2>
	<nav>
		<ul class="list-group list-group-flush">
			<?php  if ($data['childrents']): ?>
				
			<?php foreach ($data['childrents'] as $children): ?>
				<?php if ($data['type_module']=='custom'): ?>
					<li class="list-group-item"><?= $children['content'] ?></li>
				<?php else: ?>
					<li class="list-group-item"><a href="<?= ($data['type_module']=='product')? Url::to(['product/danhsach', 'slugCate' => $children['cate_slug']]): Url::to(['news/index', 'slugCate' => $children['cate_slug']]); ?>"><?= $children['name'] ?></a></li>
				<?php endif ?>
			<?php endforeach ?>
			<?php endif ?>
		</ul>
	</nav>
</section><!-- /.nav -->