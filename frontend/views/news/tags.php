<?php 
use yii\widgets\LinkPager;
use yii\helpers\Url;
$this->title = $taginfo['value'];
?>
<link rel="stylesheet" href="/frontend/web/main.css">
<link rel="stylesheet" href="/frontend/web/change.css">
<style type="text/css">
    <?php
        //include Yii::getAlias('@frontend').'/web/general.css';
        //include Yii::getAlias('@frontend').'/web/news.css';
    ?>
</style>
 <div class="row">
	<div class="col-md-12">
		Tag: <?= $taginfo['value'] ?>
	</div>
	<div class="col-md-12">
		<?php foreach ($data['news'] as $value): ?>
			<article class="item-news item-news-common">
				<div class="thumb-art">
					<a class="thumb" title="<?= $value['htmltitle'] ?>" href="<?= Url::to(['news/view', 'slugCate'=>$value['slugCate'], 'slug'=>$value['newSlug'],'idNew'=>$value['id']],true) ?>">
						<img class="lazy" src="<?= $value['images'] ?>" data-src="123.jpg">
					</a>
				</div>
				<h3 class="title-news">
					<a title="<?= $value['htmltitle'] ?>" href="<?= Url::to(['news/view', 'slugCate'=>$value['slugCate'], 'slug'=>$value['newSlug'],'idNew'=>$value['id']],true) ?>"><?= $value['name'] ?></a>
				</h3>
				<div class="description">
					<a href="<?= Url::to(['news/view', 'slugCate'=>$value['slugCate'], 'slug'=>$value['newSlug'],'idNew'=>$value['id']],true) ?>"><?= $value['short_description'] ?>&nbsp;</a>
				</div>
        	</article>
        <?php endforeach ?>
    </div>
    <div class="col-md-12">
    	<nav aria-label="Page navigation">
			<?= LinkPager::widget([
				'pagination' => $data['pages'],
				// 'hideOnSinglePage' => true,
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
				// 'listOptions' => ['class' => ['pagination']]
				// 'disableCurrentPageButton' => false
				// 'registerLinkTags' => false
				'disabledPageCssClass' => 'disabled',

			]);
			?>
		</nav>
    </div>
</div>