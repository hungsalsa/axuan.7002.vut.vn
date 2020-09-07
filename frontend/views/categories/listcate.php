<div class="blog-page">
	<div class="col-md-9">
		<?php if (count($dataNews)): ?>
		<?php foreach ($dataNews as $value): ?>
			
		<div class="blog-post  wow fadeInUp">
			<div class="image">
			<a href="blog-details.html"><img class="img-responsive" src="<?= Yii::$app->homeUrl.$value['images']?>" alt="<?= $value['htmltitle'] ?>"></a>
			</div>
			<div class="description">
				<h1><a href="blog-details.html"><?= $value['name'] ?></a></h1>
				<span class="author">Michael</span>
				<span class="review">6 Comments</span>
				<span class="date-time"><?= $value['updated_at'] ?></span>
				<p><?= $value['short_description'] ?></p>
				<a href="#" class="btn btn-upper btn-primary read-more">read more</a>
			</div>
		</div>
		
		<?php endforeach ?>
		<div class="clearfix blog-pagination filters-container  wow fadeInUp outer-top-bd">

			<div class="text-right">
				<div class="pagination-container">
					<ul class="list-inline list-unstyled">
						<li class="prev"><a href="#"><i class="fa fa-angle-left"></i></a></li>
						<li><a href="#">1</a></li>	
						<li class="active"><a href="#">2</a></li>	
						<li><a href="#">3</a></li>	
						<li><a href="#">4</a></li>	
						<li class="next"><a href="#"><i class="fa fa-angle-right"></i></a></li>
					</ul><!-- /.list-inline -->
				</div><!-- /.pagination-container -->    
			</div><!-- /.text-right -->

		</div><!-- /.filters-container -->	
		<?php endif ?>			
	</div>
			<div class="col-md-3 sidebar">
				<div class="sidebar-module-container">
					<div class="search-area outer-bottom-small">
						<form>
							<div class="control-group">
								<input placeholder="Type to search" class="search-field">
								<a href="#" class="search-button"></a>   
							</div>
						</form>
					</div>						<!-- ==============================================CATEGORY============================================== -->
					<div class="sidebar-widget outer-bottom-xs wow fadeInUp">
						<h3 class="section-title">Category</h3>
						<div class="sidebar-widget-body m-t-10">
							<div class="accordion">
								<div class="accordion-group">
									<div class="accordion-heading">
										<a href="#collapseOne" data-toggle="collapse" class="accordion-toggle collapsed">
											Camera
										</a>
									</div><!-- /.accordion-heading -->
									<div class="accordion-body collapse" id="collapseOne" style="height: 0px;">
										<div class="accordion-inner">
											<ul>
												<li><a href="#">gaming</a></li>
												<li><a href="#">office</a></li>
												<li><a href="#">kids</a></li>
												<li><a href="#">for women</a></li>
											</ul>
										</div><!-- /.accordion-inner -->
									</div><!-- /.accordion-body -->
								</div><!-- /.accordion-group -->

								<div class="accordion-group">
									<div class="accordion-heading">
										<a href="#collapseTwo" data-toggle="collapse" class="accordion-toggle collapsed">
											Desktops
										</a>
									</div><!-- /.accordion-heading -->
									<div class="accordion-body collapse" id="collapseTwo" style="height: 0px;">
										<div class="accordion-inner">
											<ul>
												<li><a href="#">gaming</a></li>
												<li><a href="#">office</a></li>
												<li><a href="#">kids</a></li>
												<li><a href="#">for women</a></li>
											</ul>
										</div><!-- /.accordion-inner -->
									</div><!-- /.accordion-body -->
								</div><!-- /.accordion-group -->

								<div class="accordion-group">
									<div class="accordion-heading">
										<a href="#collapseThree" data-toggle="collapse" class="accordion-toggle collapsed">
											Pants
										</a>
									</div><!-- /.accordion-heading -->
									<div class="accordion-body collapse" id="collapseThree" style="height: 0px;">
										<div class="accordion-inner">
											<ul>
												<li><a href="#">gaming</a></li>
												<li><a href="#">office</a></li>
												<li><a href="#">kids</a></li>
												<li><a href="#">for women</a></li>
											</ul>
										</div><!-- /.accordion-inner -->
									</div><!-- /.accordion-body -->
								</div><!-- /.accordion-group -->

								<div class="accordion-group">
									<div class="accordion-heading">
										<a href="#collapseFour" data-toggle="collapse" class="accordion-toggle collapsed">
											Bags
										</a>
									</div><!-- /.accordion-heading -->
									<div class="accordion-body collapse" id="collapseFour" style="height: 0px;">
										<div class="accordion-inner">
											<ul>
												<li><a href="#">gaming</a></li>
												<li><a href="#">office</a></li>
												<li><a href="#">kids</a></li>
												<li><a href="#">for women</a></li>
											</ul>
										</div><!-- /.accordion-inner -->
									</div><!-- /.accordion-body -->
								</div><!-- /.accordion-group -->

								<div class="accordion-group">
									<div class="accordion-heading">
										<a href="#collapseFive" data-toggle="collapse" class="accordion-toggle collapsed">
											Hats
										</a>
									</div><!-- /.accordion-heading -->
									<div class="accordion-body collapse" id="collapseFive" style="height: 0px;">
										<div class="accordion-inner">
											<ul>
												<li><a href="#">gaming</a></li>
												<li><a href="#">office</a></li>
												<li><a href="#">kids</a></li>
												<li><a href="#">for women</a></li>
											</ul>
										</div><!-- /.accordion-inner -->
									</div><!-- /.accordion-body -->
								</div><!-- /.accordion-group -->

								<div class="accordion-group">
									<div class="accordion-heading">
										<a href="#collapseSix" data-toggle="collapse" class="accordion-toggle collapsed">
											Accessories
										</a>
									</div><!-- /.accordion-heading -->
									<div class="accordion-body collapse" id="collapseSix" style="height: 0px;">
										<div class="accordion-inner">
											<ul>
												<li><a href="#">gaming</a></li>
												<li><a href="#">office</a></li>
												<li><a href="#">kids</a></li>
												<li><a href="#">for women</a></li>
											</ul>
										</div><!-- /.accordion-inner -->
									</div><!-- /.accordion-body -->
								</div><!-- /.accordion-group -->

							</div><!-- /.accordion -->
						</div><!-- /.sidebar-widget-body -->
					</div><!-- /.sidebar-widget -->
					<!-- ============================================== CATEGORY : END ============================================== -->						<div class="sidebar-widget outer-bottom-xs wow fadeInUp">
						<h3 class="section-title">tab widget</h3>
						<ul class="nav nav-tabs">
							<li class="active"><a href="#popular" data-toggle="tab">popular post</a></li>
							<li><a href="#recent" data-toggle="tab">recent post</a></li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active m-t-20" id="popular">
								<div class="blog-post inner-bottom-30 " >
									<img class="img-responsive" src="<?= Yii::$app->homeUrl?>vender/images/blog-post/sm1.jpg" alt="">
									<h4><a href="blog-details.html">Simple Blog Post</a></h4>
									<span class="author">Michael</span>
									<span class="review">6 Comments</span>
									<span class="date-time">24/06/14</span>
									<p>Integer sit amet commodo eros, sed dictum ipsum. Integer sit amet commodo eros.</p>

								</div>
								<div class="blog-post" >
									<img class="img-responsive" src="<?= Yii::$app->homeUrl?>vender/images/blog-post/sm2.jpg" alt="">
									<h4><a href="blog-details.html">Simple Blog Post</a></h4>
									<span class="author">Michael</span>
									<span class="review">6 Comments</span>
									<span class="date-time">24/06/14</span>
									<p>Integer sit amet commodo eros, sed dictum ipsum. Integer sit amet commodo eros.</p>

								</div>
							</div>

							<div class="tab-pane m-t-20" id="recent">
								<div class="blog-post inner-bottom-30" >
									<img class="img-responsive" src="<?= Yii::$app->homeUrl?>vender/images/blog-post/sm2.jpg" alt="">
									<h4><a href="blog-details.html">Simple Blog Post</a></h4>
									<span class="author">Michael</span>
									<span class="review">6 Comments</span>
									<span class="date-time">24/06/14</span>
									<p>Integer sit amet commodo eros, sed dictum ipsum. Integer sit amet commodo eros.</p>

								</div>
								<div class="blog-post">
									<img class="img-responsive" src="<?= Yii::$app->homeUrl?>vender/images/blog-post/sm1.jpg" alt="">
									<h4><a href="blog-details.html">Simple Blog Post</a></h4>
									<span class="author">Michael</span>
									<span class="review">6 Comments</span>
									<span class="date-time">24/06/14</span>
									<p>Integer sit amet commodo eros, sed dictum ipsum. Integer sit amet commodo eros.</p>

								</div>
							</div>
						</div>
					</div>
					<!-- ============================================== PRODUCT TAGS ============================================== -->
					<div class="sidebar-widget product-tag wow fadeInUp">
						<h3 class="section-title">Product tags</h3>
						<div class="sidebar-widget-body outer-top-xs">
							<div class="tag-list">					
								<a class="item" title="Phone" href="category.html">Phone</a>
								<a class="item active" title="Vest" href="category.html">Vest</a>
								<a class="item" title="Smartphone" href="category.html">Smartphone</a>
								<a class="item" title="Furniture" href="category.html">Furniture</a>
								<a class="item" title="T-shirt" href="category.html">T-shirt</a>
								<a class="item" title="Sweatpants" href="category.html">Sweatpants</a>
								<a class="item" title="Sneaker" href="category.html">Sneaker</a>
								<a class="item" title="Toys" href="category.html">Toys</a>
								<a class="item" title="Rose" href="category.html">Rose</a>
							</div><!-- /.tag-list -->
						</div><!-- /.sidebar-widget-body -->
					</div><!-- /.sidebar-widget -->
					<!-- ============================================== PRODUCT TAGS : END ============================================== -->					</div>
				</div>
			</div>