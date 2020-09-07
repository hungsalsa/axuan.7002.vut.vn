<?php use yii\helpers\Url; //dbg($dataMenu)
// $menuType = array(
// 	1 => 'Danh mục sản phẩm',
// 	2 => 'Danh mục bài viết',
//             // 3 => 'Trang nội dung',
// 	4 => 'Tự tạo'
// );
?>
<div class="container-fluid">
	<nav class="animate-dropdown yamm navbar navbar-expand-lg navbar-light">
	    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mc-horizontal-menu-collapse" aria-controls="mc-horizontal-menu-collapse" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="navbar-toggler-icon"></span>
	    </button>
	    <div class="collapse navbar-collapse" id="mc-horizontal-menu-collapse">
	        <ul class="nav navbar-nav">
	            <?php foreach ($dataMenu as $key=> $menu_root): $childrens[$menu_root['id']] = $menu_root['childrens']?>
	            		<!-- 1 => 'Danh mục sản phẩm', -->
			            <li class="nav-item dropdown yamm mega-menu">
			            	<!-- Hiển thị trên menu -->
			            	<?php if ($menu_root['type'] == 4): ?>
			            		<?= $menu_root['introduction'] ?>
			            	<?php else: ?>
			            		<?php 
			            		switch ($menu_root['type']) {
			            			case 1:
				            			$url = Url::to(['product/index', 'slug' => $menu_root['slug_cate']]);
				            			break;
			            			case 2:
				            			$url = Url::to(['news/index', 'slugCate' => $menu_root['slug_cateNews'], 'idCate' => $menu_root['link_cate']]);
				            			break;
			            			case 5:
				            			$url = Url::to(['albums/index', 'slugCate' => $menu_root['slug_cateNews'], 'idCate' => $menu_root['link_cate']]);
				            			break;

			            			default:
				            			$url = Url::to(['downloads/index', 'slugCate' => $menu_root['slug_cateNews'], 'idCate' => $menu_root['link_cate']]);
				            			break;
			            		}
			            		?>
			            		<a href="<?= $url ?>" data-hover="dropdown" class="dropdown-toggle"><?= $menu_root['name'] ?></a>
			            		
			            	<?php endif ?>
			            	<!-- Hiển thị trên menu -->

			            	<?php if (!empty($childrens[$menu_root['id']])): ?>
			            		<!-- hiển thị cấp 2 -->
			            		
			                    <ul class="dropdown-menu container-fuild">
			                        <li>
			                            <div class="yamm-content ">
			                                <div class="row">
			                                    <div class="col-xs-12 col-sm-6 col-md-9 col-menu">
			                                    	<div class="row">
				                                        <?php foreach ($childrens[$menu_root['id']] as $child1): $childs2 = $child1['childrens'];?>
				                                        	<?php if ($child1['type'] ==4): ?>
			                                        			<!--  là loại tự tạo -->
			                                        			<h2 class="title"><?= $child1['introduction'] ?></h2>
			                                        		<?php else: ?>
			                                        			<!-- ko là loại tự tạo -->
					                                                <!-- <div class="row"> -->
					                                                <div class="col-xs-12 col-sm-6 col-md-4 col-menu">
					                                                	<?php 
					                                                	switch ($child1['type']) {
					                                                		case 1:
					                                                		$url = Url::to(['product/index', 'slug' => $child1['slug_cate']]);
					                                                		break;
					                                                		case 2:
					                                                		$url = Url::to(['news/index', 'slugCate' => $child1['slug_cateNews'], 'idCate' => $child1['link_cate']]);
					                                                		break;
					                                                		case 5:
					                                                		$url = Url::to(['albums/index', 'slugCate' => $child1['slug_cateNews'], 'idCate' => $child1['link_cate']]);
					                                                		break;

					                                                		default:
					                                                		$url = Url::to(['downloads/index', 'slugCate' => $child1['slug_cateNews'], 'idCate' => $child1['link_cate']]);
					                                                		break;
					                                                	}
					                                                	?>
					                                                    <h2 class="title"><a href="<?= $url ?>"><?= $child1['name'] ?></a></h2>
					                                                    <?php if (!empty($childs2)): ?>
					                                                    	<ul class="links">
					                                                    		<?php foreach ($childs2 as $child_end): ?>
					                                                    			<?php if ($child_end['type'] ==4): ?>
					                                                    				<!--  là loại tự tạo -->
					                                                    				<li class="chil-3"><?= $child_end['introduction'] ?></li>
				                                                    				<?php else: ?>
					                                                    					<!-- ko là loại tự tạo -->
					                                                    					<?php 
					                                                    					switch ($child_end['type']) {
					                                                    						case 1:
					                                                    						$url = Url::to(['product/index', 'slug' => $child_end['slug_cate']]);
					                                                    						break;
					                                                    						case 2:
					                                                    						$url = Url::to(['news/index', 'slugCate' => $child_end['slug_cateNews'], 'idCate' => $child_end['link_cate']]);
					                                                    						break;
					                                                    						case 5:
					                                                    						$url = Url::to(['albums/index', 'slugCate' => $child_end['slug_cateNews'], 'idCate' => $child_end['link_cate']]);
					                                                    						break;

					                                                    						default:
					                                                    						$url = Url::to(['downloads/index', 'slugCate' => $child_end['slug_cateNews'], 'idCate' => $child_end['link_cate']]);
					                                                    						break;
					                                                    					}
					                                                    					?>
					                                                    					<li class="chil-3"><a href="<?= $url ?>"><?= $child_end['name'] ?></a></li>
				                                                    				<?php endif ?>
				                                                    			<?php endforeach ?>
				                                                    		</ul>
				                                                    	<?php endif ?>
					                                                </div>
					                                                <!-- </div> -->

				                                            <!-- ko là loại tự tạo -->
			                                        		<?php endif ?>

				                                        	
				                                            <!-- /.col -->
				                                        <?php endforeach ?>
			                                        </div>
			                                    </div>
			                                    <!-- /.col -->
			                                    <?php if ($menu_root['image']!=''): ?>
			                                    	
			                                    <div class="col-xs-12 col-sm-6 col-md-3 col-menu banner-image">
			                                        <img class="img-responsive" src="<?= ($menu_root['image']=='') ? Yii::$app->homeUrl.'images/no-image.jpg':$menu_root['image']?>" alt="">
			                                    </div>
			                                    <?php endif ?>
			                                    <!-- /.yamm-content -->         
			                                </div>
			                            </div>
			                        </li>
			                    </ul>
			                    <!-- hiển thị cấp 2 -->
		                    <?php endif ?>

			            </li>
			    <?php endforeach ?>
	        </ul>
	    </div>
	</nav>
</div>