<?php use yii\helpers\Url; ?>
<?php if ($data['dataNews']): ?>
	<div class="card module-navicat news_4">
		<div class="card-header text-center"><?= $data['name'] ?></div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
				<?php foreach ($data['dataNews'] as $key => $child): ?>
					<div class="blocknews item_4">
						<?php $img =  str_replace('uploads', 'thumbs', $child['images']); ?>
						<a href="<?= Url::to(['news/view', 'slugCate'=>$child['slugCate'], 'slug'=>$child['newSlug'],'idNew'=>$child['id']],true) ?>" title="<?= $child['name'] ?>"><img src="<?= ($img=='')?'/images/no-image.jpg':$img ?>" alt="<?= $child['htmltitle'] ?>" width="70" class="float-left hinhdaidienhv"></a>
						<h3 class="title"><a href="<?= Url::to(['news/view', 'slugCate'=>$child['slugCate'], 'slug'=>$child['newSlug'],'idNew'=>$child['id']],true) ?>" title="<?= $child['htmltitle'] ?>"><?= $child['name'] ?></a></h3>
						<div class="textdescript"><?= $child['short_description'] ?></div>
					</div>

                    <?php if (($key+1) == floor(count($data['dataNews'])/2)): ?>
	                </div>
				<div class="col-md-6">
                    <?php endif ?>

                <?php endforeach ?>
                </div>
					
			</div>
		</div>
	</div>
<?php endif ?>