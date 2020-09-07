<?php Use yii\helpers\Url; 
 // dbg($data['childrens'] ) ?>
<section class="news-new-left-or-right">
	<h2><?= $data['name'] ?></h2>
	<?php if ($data['childrens']): ?>
		
	<ul>
		<?php foreach ($data['childrens'] as $child): ?>
			<li>
				<a href="<?= Url::to(['news/view', 'slug' => $child['link']]) ?>"><img src="<?= Yii::$app->homeUrl.$child['images'] ?>" width="100%" alt="<?= $child['title'] ?>"></a>
				<h3><a href="<?= Url::to(['news/view', 'slug' => $child['link']]) ?>"><?= $child['name'] ?></a></h3>
			</li>
		<?php endforeach ?>
		
	</ul>
	<?php endif ?>
</section>
