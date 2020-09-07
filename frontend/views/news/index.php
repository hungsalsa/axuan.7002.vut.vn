<?php use yii\helpers\Url; 
use yii\widgets\LinkPager;
$this->title = $categories['title'];
?>
<div class="row">
	<div class="col-md-12">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
				<li class="breadcrumb-item"><a href="<?= Url::to(['news/index', 'slugCate' => $categories['slug'],'idCate'=>$categories['id']]) ?>"><?= $categories['cateName'] ?></a></li>
			</ol>
		</nav>
	</div>
	<div class="col-md-12">
		<?php foreach ($data['listNews'] as $value): ?>
			<article class="item-news item-news-common">
				<div class="thumb-art">
					<a class="thumb" title="<?= $value['htmltitle'] ?>" href="<?= Url::to(['news/view', 'slugCate'=>$value['slugCate'], 'slug'=>$value['newSlug'],'idNew'=>$value['id']],true) ?>">
						<img alt="<?= $value['htmltitle'] ?>" class="lazy" src="<?= $value['images'] ?>" data-src="123.jpg">
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