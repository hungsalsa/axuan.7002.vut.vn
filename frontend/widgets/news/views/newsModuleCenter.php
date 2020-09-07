<?php use yii\helpers\Url; ?>
<section class="news-new-4">
	<div class="news-title">
		<h2><?= $data['name'] ?></h2>
		<div class="view-all">
			<?php if ($data['childrens']): ?>
				<?php foreach ($data['childrens'] as $child): ?>
					<a class="view-all-cat" href="<?= Url::to(['news/index', 'slugCate' => $child['newSlug']]) ?>"><?= $child['name'] ?></a>
				<?php endforeach ?>
			<?php endif ?>
			<a class="view-all-h2" href="<?= Url::to(['news/index', 'slugCate' => $data['newSlug']]) ?>">Xem tất cả <span>66</span> bài viết</a>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="news-custom">
		<?= $data['content'] ?>
	</div>
	<?php if ($data['dataNews']): ?>
		<div class="news-list">
			<div class="row">
				<?php foreach ($data['dataNews'] as $new): ?>
					<div class="col-lg-4 col-xl-4">
						<div>
							<a href="<?= Url::to(['news/view', 'slug' => $new['link']]) ?>"><img src="<?= Yii::$app->homeUrl.$new['images'] ?>" width="100%" alt="<?= $new['title'] ?>"></a>
						</div>
						<h3><a href="<?= Url::to(['news/view', 'slug' => $new['link']]) ?>"><?= $new['name'] ?></a></h3>
						<div>
							<?= $new['short_description'] ?>
						</div>
					</div>
				<?php endforeach ?>
					
				</div>
			</div>
		<?php endif ?>
						</section><!-- /.news-new-4 -->