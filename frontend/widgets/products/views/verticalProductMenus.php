<?php Use yii\helpers\Url; ?>
<section class="nav">
	<h2><?= $data['name'] ?></h2>
	<?php if ($data['childrents']): ?>
	<nav class="verticalProduct">
		<ul class="list-group list-group-flush">
			<?php foreach ($data['childrents'] as $child_1): //dbg($value)?>
				<?php if ($child_1['type_module'] =='custom'): ?>
					<?php if ($child_1['childrents']): ?>
						<li class="list-group-item">
							<div>
								<a href="<?=($child_1['cate_slug'] !='')? Url::to(['product/index','slug' => $child_1['cate_slug']]):'' ?>"><?= $child_1['name'] ?></a>
								<a class="collapseverticalProduct" data-toggle="collapse" href="#<?= $child_1['type_module'].'_'.$child_1['id']?>">
								</a>
							</div>
							<ul id="<?= $child_1['type_module'].'_'.$child_1['id']?>" class="panel-collapse collapse">
								<?php foreach ($child_1['childrents'] as $child_2): ?>
									<?php if ($child_2['type_module'] =='custom'): ?>
										<li class="li2"><?= $child_1['content'] ?></li>
										<?php else: ?>
											<li class="list-group-item"><a href="<?=($child_2['cate_slug'] !='')? Url::to(['product/index','slug' => $child_2['cate_slug']]):'' ?>"><?= $child_2['name'] ?></a></li>
										<?php endif ?>
									<?php endforeach ?>
								</ul>
							</li>
						</li>
					<?php else: ?>
						<li class="list-group-item"><?= $child_1['content'] ?></li>
					<?php endif ?>
				<?php else: ?>
					<?php if ($child_1['childrents']): ?>
						<li class="list-group-item">
							<div id="li-div-<?= $child_1['id']?>">
								<a href="<?=($child_1['cate_slug'] !='')? Url::to(['product/index','slug' => $child_1['cate_slug']]):'' ?>"><?= $child_1['name'] ?></a>
								<a class="collapseverticalProduct" data-toggle="collapse" href="#<?= $child_1['type_module'].'_'.$child_1['id']?>">
								<!-- <i class="fas fa-plus"></i> -->
							</a>
								<!-- <i class="fas fa-minus"></i></a> -->
							</div>
							<ul id="<?= $child_1['type_module'].'_'.$child_1['id']?>" class="panel-collapse collapse">
								<?php foreach ($child_1['childrents'] as $child_2): ?>
									<?php if ($child_2['type_module'] =='custom'): ?>
										<li class="li2"><?= $child_1['content'] ?></li>
										<?php else: ?>
											<li class="list-group-item"><a href="<?=($child_2['cate_slug'] !='')? Url::to(['product/index','slug' => $child_2['cate_slug']]):'' ?>"><?= $child_2['name'] ?></a></li>
										<?php endif ?>
									<?php endforeach ?>
								</ul>
							</li>
					<?php else: ?>
						<li class="list-group-item"><a href="<?=($child_1['cate_slug'] !='')? Url::to(['product/index','slug' => $child_1['cate_slug']]):'' ?>"><?= $child_1['name'] ?></a></li>
					<?php endif ?>

				<?php endif ?>
			<?php endforeach ?>
		</ul>
	</nav>
	<?php endif ?>
</section>
<!-- /.nav -->
