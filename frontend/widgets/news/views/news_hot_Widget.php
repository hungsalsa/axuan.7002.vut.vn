<?php Use yii\helpers\Url;?>
<?php if ($data): ?>

 <div id="hot-news">
 	<div class="panel panel-default">
 		<!-- <div class="panel-heading">Panel heading without title</div> -->
 		<div class="panel-body">
 			<div class="row">
 				<?php foreach ($data as $key => $value): ?>
 					<?php if ($key==0): ?>
		 				<div class="col-md-7 col-sm-7">
		 					<div class="text-center backgroup-img"><a href="<?= Url::to(['news/view', 'slugCate'=>$value['slugCate'], 'slug'=>$value['newSlug'],'idNew'=>$value['id']],true) ?>" title="<?= $value['htmltitle'] ?>"><img src="<?= ($value['images']=='')? '/images/no-image.jpg': $value['images'] ?>" alt="V/v phối hợp lập danh sách điển hình tập thể, cá nhân về tham dự Hội nghị điển hình tiên tiến huyện lần thứ III (2016-2020)" width="320" class="img-thumbnail img-private"></a></div>
		 					<h2 class="margin-bottom-sm"><a href="#l" title="<?= $value['htmltitle'] ?>"><?= $value['name'] ?></a></h2>
		 					<p class="descrip"><?= $value['short_description'] ?> </p>
		 				</div>
		 				<div class="col-md-5 col-sm-5">
		 					<ul class="column-margin-left fix-sub-news">
		 						<div class="bg-hot-news-title"><h3>TIN NỔI BẬT</h3></div>
	 				<?php else: ?>
 						<li class="clearfix">
 							<a class="show black h4" href="<?= Url::to(['news/view', 'slugCate'=>$value['slugCate'], 'slug'=>$value['newSlug'],'idNew'=>$value['id']],true) ?>" title="<?= $value['htmltitle'] ?>"><img src="<?= ($value['images']=='')? '/images/no-image.jpg': $value['images'] ?>" alt="Chính sách hỗ trợ DOANH NGHIỆP" class="float-right" style="width:100px;"><?= $value['name'] ?></a>
 						</li>
 					<?php endif ?>
 				<?php endforeach ?>
 					</ul>
 				</div>
 			</div>
 		</div>

 	</div>
 </div>
<?php endif ?>