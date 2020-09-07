<?php 
use yii\widgets\LinkPager;
use yii\helpers\Url;
$this->title = 'Thư viện ảnh';
 ?>
<p style="font-size:1.5rem;font-weight:bold;margin-top:0">Thư viện ảnh</p>
<div class="row">
    <div class="col-md-12">
        <div class="card-columns">
        	<?php foreach ($data['listAlbums'] as $value): ?>
        		<div class="card">
        			<div class="hovereffect">
        			    <a href="<?= Url::to(['albums/view', 'slug'=>$value['slug']],true) ?>" title="" class="overlay">
        				    <img class="card-img-top img-responsive" src="<?= isset($value['oneImages']['image'])? $value['oneImages']['image']:'/images/no-image.jpg' ?>" alt="">
        				</a>
        				<a href="<?= Url::to(['albums/view', 'slug'=>$value['slug']],true) ?>" title="" class="overlay"> 
        					<h3 style="text-align:center"><?= $value['name'] ?> </h3>
        					<p><?= $value['descriptions'] ?> </p>
        				</a>
        			</div>
        		</div>
        	<?php endforeach ?>
        </div>
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
<?php
// $this->registerCssFile('@web/album.css', ['depends' => [yii\web\JqueryAsset::className()]]);