<?php use yii\helpers\Url; ?>
<?php if ($data): ?>
	<div class="card module-navicat">
		<div class="card-header text-center bg-primary text-white">Tin mới nhất</div>
		<div class="card-body">
				<?php foreach ($data as $key => $child): ?>
					<div class="blocknews">
						<a href="<?= Url::to(['news/view', 'slugCate'=>$child['slugCate'], 'slug'=>$child['newSlug'],'idNew'=>$child['id']],true) ?>" title="das"><img src="<?= ($child['images']=='')? '/images/no-image.jpg':$child['images'] ?>" alt="HỢP TÁC XÃ NÔNG LÂM NGHIỆP HOÀI TRƯƠNG - CHƯ SÊ" width="70" class="float-left hinhdaidienhv"></a>
						<h3 class="title"><a href="<?= Url::to(['news/view', 'slugCate'=>$child['slugCate'], 'slug'=>$child['newSlug'],'idNew'=>$child['id']],true) ?>" title="<?= $child['htmltitle'] ?>"><?= $child['name'] ?></a></h3>
					</div>

                <?php endforeach ?>
					<!-- <div class="blocknews">
						<a href="#ada" title="das"><img src="http://hoidoanhnghiepchuse.com/assets/doanhnghiep/2019_10/logo-hoai-truong.png" alt="HỢP TÁC XÃ NÔNG LÂM NGHIỆP HOÀI TRƯƠNG - CHƯ SÊ" width="70" class="img-thumbnail pull-left hinhdaidienhv"></a>
						<h3 class="title">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum corporis nam laborum, illo asperiores recusandae deserunt.</h3>
						<div class="textdescript">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus est laboriosam voluptate sit praesentium corporis nemo autem nobis placeat perferendis!</div>
					</div>
					<div class="blocknews">
						<a href="#ada" title="das"><img src="http://hoidoanhnghiepchuse.com/assets/doanhnghiep/2019_10/logo-hoai-truong.png" alt="HỢP TÁC XÃ NÔNG LÂM NGHIỆP HOÀI TRƯƠNG - CHƯ SÊ" width="70" class="img-thumbnail pull-left hinhdaidienhv"></a>
						<h3 class="title">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum corporis nam laborum, illo asperiores recusandae deserunt.</h3>
						<div class="textdescript">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus est laboriosam voluptate sit praesentium corporis nemo autem nobis placeat perferendis!</div>
					</div>
					<div class="blocknews">
						<a href="#ada" title="das"><img src="http://hoidoanhnghiepchuse.com/assets/doanhnghiep/2019_10/logo-hoai-truong.png" alt="HỢP TÁC XÃ NÔNG LÂM NGHIỆP HOÀI TRƯƠNG - CHƯ SÊ" width="70" class="img-thumbnail pull-left hinhdaidienhv"></a>
						<h3 class="title">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum corporis nam laborum, illo asperiores recusandae deserunt.</h3>
						<div class="textdescript">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus est laboriosam voluptate sit praesentium corporis nemo autem nobis placeat perferendis!</div>
					</div>
									
									<div class="col-md-6">
					
									</div> -->
		</div>
	</div>
<?php endif ?>