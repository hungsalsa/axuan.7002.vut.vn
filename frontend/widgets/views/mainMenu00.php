<?php Use yii\helpers\Url; ?>
<section class="navigation">
	<div class="container-fluid">
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
		  <!-- <a class="navbar-brand" href="#">Logo</a> -->
		  <!--CHO UP LOGO TRONG ADMIN, NẾU KO UP THÌ ẨN-->
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>
		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <ul class="navbar-nav mr-auto">
		    	<?php foreach ($data as $menu): ?>
		    		<?php if ($menu['type'] !=4): ?>
		    			<?php if ($menu['childrens']): ?>
		    				<li class="nav-item dropdown">
		    					<a class="nav-link dropdown-toggle" href="<?= ($menu['type']==1)? Url::to(['product/index', 'slug' => $menu['slug_cate']]): Url::to(['news/index', 'slugCate' => $menu['slug'], 'idCate' => $menu['link_cate']]);?>" id="navbarDropdown<?= $menu['id']?>" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		    						<?=  $menu['name'] ?>
		    					</a>
		    					<div class="dropdown-menu" aria-labelledby="navbarDropdown<?= $menu['id']?>">
		    						<?php foreach ($menu['childrens'] as $child): ?>
		    							<?php if ($child['type']==4): ?>
		    								<?= $child['introduction'] ?>
		    							<?php else: ?>
		    								<a class="dropdown-item" href="<?= ($child['type']==1)? Url::to(['product/index', 'slug' => $child['slug_cate']]): Url::to(['news/index', 'slugCate' => $child['slug'], 'idCate' => $child['link_cate']]);?>"><?=  $child['name'] ?></a>
		    							<?php endif ?>
		    						<?php endforeach ?>
		    					</div>
		    				</li>
		    				
		    			<?php else: ?>
		    				<li class="nav-item">
		    					<a class="nav-link" href="<?= ($menu['type']==1)? Url::to(['product/index', 'slug' => $menu['slug_cate']]): Url::to(['news/index', 'slugCate' => $menu['slug'], 'idCate' => $menu['link_cate']]);?>"><?=  $menu['name'] ?></a>
		    				</li>
		    			<?php endif ?>
		    		<?php else:
		    			?>
		    			<li class="nav-item">
		    				<?= $menu['introduction'] ?>
		    			</li>
		    		<?php endif ?>
		    	<?php endforeach ?>
		      
		    </ul>
		  </div>
		</nav>
	</div>
</section><!-- /.navigation -->