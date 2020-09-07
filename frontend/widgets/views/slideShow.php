<div class="container-fluid">
	<?php if (!empty($slideshow)): ?>
	<div class="row">
		<div class="col-lg-12 col-xl-12">
			<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
			  <ol class="carousel-indicators">
			  	<?php $i=0; while($i<count($slideshow)): ?>
			  	<li data-target="#carouselExampleCaptions" data-slide-to="<?= $i ?>" class="<?= ($i==0)?'active':'' ?>"></li>
			  	<?php $i++; endwhile ?>
			  </ol>
			  <div class="carousel-inner">
			  	<?php foreach ($slideshow as $key => $banner):  //dbg($banner) ?>
			  		<div class="carousel-item<?= ($key==0)?' active':'' ?>">
			  			<img src="<?= $banner['image']; ?>" class="d-block w-100" alt="<?= $banner['alt'] ?>">
			  			<div class="carousel-caption d-none d-md-block">
			  				<h5><a href="<?= $banner['url'] ?>" title=""> <?= $banner['name'] ?></a></h5>
			  				<?= $banner['content'] ?>
			  			</div>
			  		</div>
			  	<?php endforeach ?>
			    
			  </div>
			  <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
			    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
			    <span class="sr-only">Previous</span>
			  </a>
			  <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
			    <span class="carousel-control-next-icon" aria-hidden="true"></span>
			    <span class="sr-only">Next</span>
			  </a>
			</div>
		</div>
	</div>
	<?php endif ?>
	<?php if ($settingModules): ?>
		<?php foreach ($settingModules as $module): ?>
			<div class="row">
				<div class="col-lg-2 col-xl-12"><!--BANNER-->
					<?= $module['content'] ?>
				</div>
			</div>
		<?php endforeach ?>
	<?php endif?>
</div>