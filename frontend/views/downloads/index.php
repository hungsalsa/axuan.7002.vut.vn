<?php
use yii\helpers\Html;
$categories = $data['categories'];
$result = $data['downloads'];
$this->title = $categories['title'];
?>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="header">
				<h1 class="title text-center"><?= Html::encode($categories['cateName']) ?></h1>
				<p class="category"><?= $categories['descriptions'] ?></p>
			</div>
			<div class="content table-responsive table-full-width">
				<table class="table table-hover table-striped">
					<thead>
						<tr>
							<th>Tên</th>
							<th width="65%">Mô tả</th>
							<th>Download</th>
						</tr>
					</thead>
					<tbody>
						<?php if ($categories['downName'] != ''): ?>
						<?php /*dbg($result['downloads']);*/ foreach ($result['downloads'] as $key => $value): 
							if($value->cate_id==$categories['id']):?>
							<tr>
								<td><?= $value->name ?></td>
								<td><?= $value->descriptions ?></td>
								<td class="text-right"><?php echo Html::a('<i class="fas fa-download pull-right">  Tải xuống </i>',['downloads/view','slug'=>$value->link],['class'=>'btn btn-primary']); ?></td>
							</tr>
						<?php unset($result['downloads'][$key]); endif; endforeach ?>
						<?php endif ?>
						<?php if (!empty($categories['childrents'])): ?>
							<?php foreach ($categories['childrents'] as $child): ?>
								<?php if ($child['downName'] != ''): ?>
									<tr>
										<td colspan="3"><h2><?= $child['cateName'] ?></h2></td>
									</tr>
									<?php foreach ($result['downloads'] as $key => $value): 
										if($value->cate_id==$child['id']):?>
										<tr>
											<td><?= $value->name ?></td>
											<td><?= $value->descriptions ?></td>
											<td class="text-right"><?php echo Html::a('<i class="fas fa-download pull-right">  Tải xuống </i>',['downloads/view','slug'=>$value->link],['class'=>'btn btn-primary']); ?></td>
										</tr>
										<?php unset($result['downloads'][$key]);  
									endif ;endforeach ?>
								<?php endif ?>
								<?php if (!empty($child['childrents'])): ?>
									<?php foreach ($child['childrents'] as $child1): ?>
										<?php if ($child1['downName'] != ''): ?>
											<tr>
												<td colspan="3"><h2><?= $child1['cateName'] ?></h2></td>
											</tr>
											<?php foreach ($result['downloads'] as $key => $value): 
												if($value->cate_id==$child1['id']):?>
													<tr>
														<td><?= $value->name ?></td>
														<td><?= $value->descriptions ?></td>
														<td class="text-right"><?php echo Html::a('<i class="fas fa-download pull-right">  Tải xuống </i>',['downloads/view','slug'=>$value->link],['class'=>'btn btn-primary']); ?></td>
													</tr>
												<?php unset($result['downloads'][$key]); endif; endforeach; ?>
										<?php endif ?>
									<?php endforeach ?>
								<?php endif ?>
							<?php endforeach ?>
						<?php endif ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<nav aria-label="Page navigation">
			<?=  yii\widgets\LinkPager::widget([
				'pagination' => $result['pages'],
				'hideOnSinglePage' => true,
				'firstPageLabel'=>'|<',
				'lastPageLabel'=>'>|',
				'prevPageLabel'=>'<<',
				'nextPageLabel'=>'>>',
				'maxButtonCount'=>3,
                        // 'linkAttributes'=>['class' => 'page-link'],
                        // 'route' => 'article/index'
                        // 'pageParam' => 'page',
				'options' => ['class' => 'pagination justify-content-end'],
				'linkContainerOptions' => ['class' => 'page-item'],
				'linkOptions' => ['class' => 'page-link'],
					// 'listOptions' => ['class' => ['pagination']],
					// 'disableCurrentPageButton' => false
					// 'registerLinkTags' => false
				'disabledPageCssClass' => 'disabled',

			]);
			?>
		</nav>
	</div>
</div>