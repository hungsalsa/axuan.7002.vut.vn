<?php Use yii\helpers\Url; ?>
<section class="nav">
	<h2><?= $data['name'] ?></h2>
	<?php if ($data['childrents']): ?>
	<nav>
		<ul class="list-group list-group-flush">
			<!-- <li class="list-group-item"><a href="#">Điện thoại</a>
				<ul class="ul2">
					<li class="li2"><a href="#">Apple</a></li>
					<li class="li2"><a href="#">Samsung</a></li>
					<li class="li2"><a href="#">Nokia</a></li>
				</ul>
			</li> -->
			<?php foreach ($data['childrents'] as $value): ?>
				<li class="list-group-item"><a href="<?= Url::to(['news/index', 'slugCate' => $data['newsCategories'][$value['cate_slug']]]) ?>"><?= $value['name'] ?></a></li>
			<?php endforeach ?>
		</ul>
	</nav>
	<?php endif ?>
</section>
<!-- /.nav -->
