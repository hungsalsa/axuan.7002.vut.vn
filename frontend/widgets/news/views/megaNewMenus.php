<?php Use yii\helpers\Url; ?>
<section class="nav">
	<h2><a href="<?= Url::to(['news/view', 'slugCate'=>$data['slugCate'], 'slug'=>$data['slugCateNews'],'idNew'=>$data['cate_id']],true)?>" title="<?= $data['name'] ?>"><?= $data['name'] ?></a></h2>
	<?php if ($data['childrents']): ?>
	<nav class="verticalProduct">
		<ul class="list-group list-group-flush">
			<?php foreach ($data['childrents'] as $child_1): //dbg($value)?>
				<?php if ($child_1['type_module'] !='news') continue; ?>
					<?php if ($child_1['childrents']): ?>
						<li class="list-group-item">
							<div id="li-div-<?= $child_1['id']?>">
								<a href="<?= Url::to(['news/view', 'slugCate'=>$child_1['slugCate'], 'slug'=>$child_1['slugCateNews'],'idNew'=>$child_1['cate_id']],true)?>" title="<?= $child_1['name'] ?>"><?= $child_1['name'] ?></a>
								<a class="collapseverticalProduct" data-toggle="collapse" href="#<?= $child_1['type_module'].'_'.$child_1['id']?>">
								<!-- <i class="fas fa-plus"></i> -->
							</a>
								<!-- <i class="fas fa-minus"></i></a> -->
							</div>
							<ul id="<?= $child_1['type_module'].'_'.$child_1['id']?>" class="panel-collapse collapse">
								<?php foreach ($child_1['childrents'] as $child_2): ?>
									<?php if ($child_2['type_module'] !='news') continue; ?>
									<li class="list-group-item"><a href="<?= Url::to(['news/view', 'slugCate'=>$child_2['slugCate'], 'slug'=>$child_2['slugCateNews'],'idNew'=>$child_2['cate_id']],true)?>" title="<?= $child_2['name'] ?>"><?= $child_2['name'] ?></a></li>
									<?php endforeach ?>
								</ul>
							</li>
					<?php else: ?>
						<li class="list-group-item"><a href="<?=($child_1['cate_slug'] !='')? Url::to(['product/index','slug' => $child_1['cate_slug']]):'' ?>"><?= $child_1['name'] ?></a></li>
					<?php endif ?>

			<?php endforeach ?>
		</ul>
	</nav>
	<?php endif ?>
</section>
<!-- /.nav -->
