<?php use yii\helpers\Url; ?>
<section class="header-top">
	<div class="container-fluid">
		<?php if (!empty($settingModules)): ?>
			<?php foreach ($settingModules as $module): ?>
				<div class="row">
				    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
					    <div class="custom-top"><?= $module['content'] ?></div>
					</div>
				</div>
			<?php endforeach ?>
		<?php endif ?>
		<div class="row">
			<div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-3">
				<div class="logo">
					<a href="/"><img src="<?= Yii::$app->params['config']['seohome']['logo'] ?>" width="100%" alt=""></a>
				</div>
			</div>
			<div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
				<div class="search">
					<div class="mb-3">
						<form action="" accept-charset="utf-8" class="input-group" id="FormWebsearch">
							<input name="keySearch" id="home-search-web" type="text" class="form-control" placeholder="Tìm kiếm" aria-describedby="button-addon2" onkeyup="suggestSearch(event)">
							<div class="input-group-append">
								<button class="btn btn-outline-secondary" type="submit" id="button-addon2">Tìm kiếm</button>
							</div>
						</form>
					</div>
					<div id="search-result"><ul class="suggest"></ul></div>
				</div>
			</div>
			<div class="col-5 col-sm-5 col-md-6 col-lg-2 col-xl-2">
			    <?= \frontend\widgets\ListcartWidget::widget() ?>
			</div>
			<div class="col-7 col-sm-7 col-md-6 col-lg-3 col-xl-3">
			    <div class="custom">
			        <p>Tư vấn & hỗ trợ</p>
                	<p>Hotline: <a href="tel:0909445188">0909.445.188</a></p>
                </div>
			</div>
		</div>
	</div>
</section>