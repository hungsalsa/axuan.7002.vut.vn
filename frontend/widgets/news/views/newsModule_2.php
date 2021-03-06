<?php use yii\helpers\Url; ?>
<?php if ($data['dataNews']): ?>
<section class="module-navicat news-2">
	<div class="header">
		<h2><?= $data['name'] ?></h2>
		<div class="viewallcat d-none d-sm-block">
			<?php if (!empty($data['childrents'])): ?>
				<?php foreach ($data['childrents'] as $child): ?>
					<a class="view-all-cat" href="<?= Url::to(['news/index', 'slugCate' => $child['slugCateNews'], 'idCate' => $child['id']]) ?>"><?= $child['name'] ?></a>
				<?php endforeach ?>
			<?php endif ?>
			<a href="<?= Url::to(['news/index', 'slugCate' => $data['slugCateNews'], 'idCate' => $data['id']]) ?>">Xem tất cả</a>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="news-custom"><?= $data['content'] ?></div>
	<div class="news-list">
		<div class="row">
			<div class="col-lg-6 col-xl-6" style="padding-left: 2rem;">
				<?php $first = $data['dataNews'][0] ?>
				<h3><a href="<?= Url::to(['news/view', 'slugCate'=>$first['slugCate'], 'slug'=>$first['newSlug'],'idNew'=>$first['id']],true) ?>"><?= $first['name'] ?></a></h3>
					<div class="row">
						<div class="col-lg-5 col-xl-5">
							<a href="<?= Url::to(['news/view', 'slugCate'=>$first['slugCate'], 'slug'=>$first['newSlug'],'idNew'=>$first['id']],true) ?>"><img src="<?= ($first['images']=='')?'/images/no-image.jpg': $first['images'] ?>" width="100%" alt="<?= $first['htmltitle'] ?>"></a>
						</div>
						<div class="col-lg-7 col-xl-7">
							<?= $first['short_description'] ?>
						</div>
					</div>
				<?php unset($data['dataNews'][0]); ?>
				<?php if ($data['dataNews']): ?>
					<div class="row">
						<?php foreach ($data['dataNews'] as $keyn => $new): ?>
							<?php if ($keyn <4 ): ?>
							<h3><a href="<?= Url::to(['news/view', 'slugCate'=>$new['slugCate'], 'slug'=>$new['newSlug'],'idNew'=>$new['id']],true) ?>"><?= $new['name'] ?></a></h3>
							<?php unset($data['dataNews'][$keyn]); endif ?>
						<?php endforeach ?>
					</div>
				<?php endif ?>
			</div>
			<div class="col-lg-6 col-xl-6">
				<?php if ($data['dataNews']): ?>
					<?php foreach ($data['dataNews'] as $keyn => $new): ?>
						<div class="row">
							<div class="col-lg-3 col-xl-3">
								<a href="<?= Url::to(['news/view', 'slugCate'=>$new['slugCate'], 'slug'=>$new['newSlug'],'idNew'=>$new['id']],true) ?>"><img src="<?= ($first['images']=='')?'/images/no-image.jpg': $new['images'] ?>" width="100%" alt="<?= $new['htmltitle'] ?>"></a>
							</div>
							<div class="col-lg-9 col-xl-9">
								<h3><a href="<?= Url::to(['news/view', 'slugCate'=>$new['slugCate'], 'slug'=>$new['newSlug'],'idNew'=>$new['id']],true) ?>"><?= $new['name'] ?></a></h3>
								<div><?= $new['short_description'] ?></div>
							</div>
						</div>
					<?php endforeach ?>
				<?php endif ?>
			</div>
			
		</div>
	</div>
</section><!-- /.news-new-2 -->
<?php endif ?>