<?php Use yii\helpers\Url; ?>
<?php //dbg($data) ?>
<section class="nav">
	<h2><a href="<?= Url::to(['news/index', 'slugCate' => $newsCategories[$data['cate_slug']]]) ?>"><?= $data['name'] ?></a></h2>
	<?php if ($data['childrents']): ?>
	<nav>
		<ul class="list-group list-group-flush">
			<!-- <li class="list-group-item"><a href="#">Tin trong nước</a>
				<ul class="ul2">
					<li class="li2"><a href="#">Xã hội</a></li>
					<li class="li2"><a href="#">Pháp luật</a></li>
					<li class="li2"><a href="#">Thể thao</a></li>
				</ul>
			</li> -->
			<?php foreach ($data['childrents'] as $child): ?>
				<li class="list-group-item"><a href="<?= Url::to(['news/index', 'slugCate' => $newsCategories[$child['cate_slug']]]) ?>"><?= $child['name'] ?></a></li>
			<?php endforeach ?>
		</ul>
	</nav>
	<?php endif ?>
</section><!-- /.nav -->