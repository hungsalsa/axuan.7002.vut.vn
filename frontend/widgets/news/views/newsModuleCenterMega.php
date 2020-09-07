<?php use yii\helpers\Url; ?>
<section class="news-new-3">
	<div class="news-title">
		<h2><?= $data['name'] ?></h2>
		<div class="view-all">
			<?php if ($data['childrens']): ?>
				<?php foreach ($data['childrens'] as $child): ?>
					<a class="view-all-cat" href="<?= Url::to(['news/index', 'slugCate' => $child['newSlug']]) ?>"><?= $child['name'] ?></a>
				<?php endforeach ?>
			<?php endif ?>
			<a class="view-all-h2" href="<?= Url::to(['news/index', 'slugCate' => $data['newSlug']]) ?>">Xem tất cả <span>66</span> bài viết</a>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="news-custom">
		<?= $data['content'] ?>
	</div>
	<?php if ($data['dataNews']): ?>
		
	
	<div class="news-list">
		<div class="row">

			<?php foreach ($data['dataNews'] as $key => $new): ?>
				<div class="col-lg-6 col-xl-6">
					<?php if ($key==0): ?>
						
					<h3><a href="#">Nữ sinh 9X mơ làm cô giáo</a></h3>
					<div class="row">
						<div class="col-lg-5 col-xl-5">
							<a href="#"><img src="<?= Yii::$app->homeUrl.$new['images'] ?>" alt="<?= $new['title'] ?>"></a>
						</div>
						<div class="col-lg-7 col-xl-7">
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis incidunt debitis numquam dicta accusamus natus, ipsam dolorum et deleniti totam.</p>
						</div>
					</div>
					<?php endif;continue ?>
					<div class="col-lg-12 col-xl-12">
						<h3><a href="#">Lý do kinh hoàng tại sao cả thế giới nể phục Việt Nam chưa bao giờ bị khủng bố</a></h3>
						<h3><a href="#">Phương Thanh: Chẳng có ý nghĩa gì nếu cô độc</a></h3>
						<h3><a href="#">Bài phát biểu đáng ngẫm của giáo sư ĐH Bắc Kinh: Sinh viên ngồi nghe không lọt một từ!</a></h3>
						<h3><a href="#">Ngành Giao thông Vận tải hoàn thành nhiệm vụ với nỗ lực, quyết tâm cao</a></h3>
					</div>
				</div>

			<?php if ($key >= 5): ?>
				<div class="col-lg-6 col-xl-6">
					<div class="row">
						<div class="col-lg-3 col-xl-3">
							<a href="#"><img src="<?= Yii::$app->homeUrl.$new['images'] ?>" alt="<?= $new['title'] ?>"></a>
						</div>
						<div class="col-lg-9 col-xl-9">
							<h3><a href="#">Nữ sinh 9X mơ làm cô giáo</a></h3>
							<div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis incidunt debitis numquam dicta accusamus natus, ipsam dolorum et deleniti totam.</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-3 col-xl-3">
							<a href="#"><img src="<?= Yii::$app->homeUrl.$new['images'] ?>" alt="<?= $new['title'] ?>"></a>
						</div>
						<div class="col-lg-9 col-xl-9">
							<h3><a href="#">Nữ sinh 9X mơ làm cô giáo</a></h3>
							<div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis incidunt debitis numquam dicta accusamus natus, ipsam dolorum et deleniti totam.</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-3 col-xl-3">
							<a href="#"><img src="<?= Yii::$app->homeUrl.$new['images'] ?>" alt="<?= $new['title'] ?>"></a>
						</div>
						<div class="col-lg-9 col-xl-9">
							<h3><a href="#">Nữ sinh 9X mơ làm cô giáo</a></h3>
							<div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis incidunt debitis numquam dicta accusamus natus, ipsam dolorum et deleniti totam.</div>
						</div>
					</div>
				</div>
				
			<?php endif ?>
		<?php endforeach ?>
		</div>
	</div>
	<?php endif ?>
</section><!-- /.news-new-3 -->