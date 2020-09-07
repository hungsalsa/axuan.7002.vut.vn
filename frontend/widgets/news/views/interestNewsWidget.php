<?php use yii\helpers\Url; ?>
<?php if ($data): ?>
	<div class="card module-navicat">
		<div class="card-header text-center bg-primary text-white">Quan tâm nhiều</div>
		<div class="card-body">
				<?php foreach ($data as $key => $child): ?>
					<div class="blocknews">
						<a href="<?= Url::to(['news/view', 'slugCate'=>$child['slugCate'], 'slug'=>$child['newSlug'],'idNew'=>$child['id']],true) ?>" title="das"><img src="<?= ($child['images']=='')? '/images/no-image.jpg':$child['images'] ?>" alt="HỢP TÁC XÃ NÔNG LÂM NGHIỆP HOÀI TRƯƠNG - CHƯ SÊ" width="70" class="float-left hinhdaidienhv"></a>
						<h3 class="title"><a href="<?= Url::to(['news/view', 'slugCate'=>$child['slugCate'], 'slug'=>$child['newSlug'],'idNew'=>$child['id']],true) ?>" title="<?= $child['htmltitle'] ?>"><?= $child['name'] ?></a></h3>
					</div>

                <?php endforeach ?>
		</div>
	</div>
<?php endif ?>