<?php use yii\helpers\Url; ?>
<section class="module-navicat news-1">
	<div class="header">
	    <h2><?= $data['name'] ?></h2>
    	<div class="viewallcat d-none d-sm-block">
    		<?php if (!empty($data['childrents'])): ?>
    			<?php foreach ($data['childrents'] as $child): ?>
    				<a class="view-all-cat" href="<?= Url::to(['news/index', 'slugCate' => $child['slugCateNews'], 'idCate' => $child['id']]) ?>"><?= $child['name'] ?></a>
    			<?php endforeach ?>
    		<?php endif ?>
    		<a href="<?= Url::to(['news/index', 'slugCate' => $data['slugCateNews'],'idCate'=>$data['id']]) ?>">Xem tất cả</a>
    	</div>
	</div>
	<div class="clearfix"></div>
	<div class="news-custom"><?= $data['content'] ?></div>
	<?php if ($data['dataNews']): ?>
	<div class="news-list">
		<div class="row">
			<?php $first_new = $data['dataNews'][0]; unset($data['dataNews'][0]); ?>
			<div class="col-lg-6 col-xl-6">
				<h3><a href="<?= Url::to(['news/view', 'slugCate'=>$first_new['slugCate'], 'slug'=>$first_new['newSlug'],'idNew'=>$first_new['id']],true) ?>"><?= $first_new['name'] ?></a></h3>
				<div class="row">
					<div class="col-lg-6 col-xl-6">
						<a href="<?=Url::to(['news/view', 'slugCate'=>$first_new['slugCate'], 'slug'=>$first_new['newSlug'],'idNew'=>$first_new['id']],true)
						  ?>"><img src="<?= $first_new['images'] ?>" width="100%" alt="<?= $first_new['htmltitle'] ?>"></a>
					</div>
					<div class="col-lg-6 col-xl-6">
						<?= $first_new['short_description'] ?>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-xl-6">
			<?php foreach ($data['dataNews'] as $keyn => $new): ?>
				<h3><a href="<?= Url::to(['news/view', 'slugCate'=>$new['slugCate'], 'slug'=>$new['newSlug'],'idNew'=>$new['id']],true) ?>"><?= $new['name'] ?></a></h3>
			<?php endforeach ?>
				
			</div>
		</div>
	</div>
	<?php endif ?>
</section>
<!-- /.news-new-1 -->