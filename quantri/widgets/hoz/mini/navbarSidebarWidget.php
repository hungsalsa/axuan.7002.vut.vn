<?php use yii\helpers\Html;use yii\helpers\Url; ?><div class="navbar-default sidebar"role="navigation"><div class="sidebar-nav"><div class="sidebar-head"><h3><span class="fa-fw open-close"><i class="ti-menu hidden-xs"></i><i class="ti-close visible-xs"></i></span> <span class="hide-menu">Menu chính</span></h3></div><ul class="nav"id="side-menu"><li><a href="javascript:void(0)"class="waves-effect"><span class="hide-menu">Sản phẩm<span class="fa arrow"></span> <span class="label label-rouded label-info pull-right">20</span></span></a><ul class="nav nav-second-level"><li><a href="<?=Url::to(['/products/default'],true)?>"><span class="hide-menu">Quản lý sản phẩm</span></a></li><li><a href="<?=Url::to(['/products/thuoctinhsp'],true)?>"><span class="hide-menu">Quản lý thuộc tính</span></a></li><li><a href="<?=Url::to(['/products/productcategory'],true)?>"><span class="hide-menu">Quản lý danh mục</span></a></li><li><a href="<?=Url::to(['/tags/index'],true)?>"><span class="hide-menu">Danh sách Tag</span></a></li></ul></li><li><a href="javascript:void(0)"class="waves-effect"><span class="hide-menu">Tin tức<span class="fa arrow"></span></span></a><ul class="nav nav-second-level"><li><a href="<?=Url::to(['/news/default'],true)?>"><span class="hide-menu">Quản lý tin tức</span></a></li><li><a href="<?=Url::to(['/news/downloads'],true)?>"><span class="hide-menu">Quản lý downloads</span><span class="fa arrow"></span></a><ul><li><a href="<?=Url::to(['/news/downloads'],true)?>"><span class="hide-menu">Danh sách</span></a></li><li><a href="<?=Url::to(['/news/categories/downloads'],true)?>"><span class="hide-menu">Danh mục</span></a></li></ul></li><li><a href="javascript:void(0)"class="waves-effect"><span class="hide-menu">Quản lý albums</span></a> <span class="fa arrow"></span><ul><li><a href="<?=Url::to(['/news/album'],true)?>"><span class="hide-menu">Danh sách</span></a></li><li><a href="<?=Url::to(['/news/categories/albums'],true)?>"><span class="hide-menu">Danh mục</span></a></li></ul><li><a href="<?=Url::to(['/news/categories'],true)?>"><span class="hide-menu">Quản lý danh mục</span></a></li></ul></li><li><a href="javascript:void(0)"class="waves-effect"><span class="hide-menu">Cài đặt<span class="fa arrow"></span></span></a><ul class="nav nav-second-level"><li><a href="<?=Url::to(['/setting/menus'],true)?>"><span class="hide-menu">Quản lý menus</span></a></li><li><a href="<?=Url::to(['/setting/setting-modules'],true)?>"><span class="hide-menu">Quản lý modules</span></a></li><li><a href="<?=Url::to(['/setting/banner'],true)?>"><span class="hide-menu">Slideshow</span></a></li><li><a href="<?=Yii::$app->homeUrl?>setting/settingbrands"><span class="hide-menu">Logo đối tác</span></a></li><li><a href="<?=Yii::$app->homeUrl?>setting/default/update?id=1"><span class="hide-menu">Thông tin website</span></a></li></ul></li><li><a href="javascript:void(0)"class="waves-effect"><span class="hide-menu">Liên hệ<span class="fa arrow"></span> <span class="label label-rouded label-info pull-right">20</span></span></a><ul class="nav nav-second-level"><li><a href="<?=Url::to(['/products/order'],true)?>"><span class="hide-menu">Đơn hàng</span></a></li><li><a href="<?=Url::to(['/customer/customer'],true)?>"><span class="hide-menu">Khách liên hệ</span></a></li><li><a href="<?=Url::to(['/customer/contacts'],true)?>"><span class="hide-menu">Hội viên mới</span></a></li></ul></li><?php $menuItems='<li style="height: 42px;line-height: 42px;">'.Html::beginForm(['/site/logout'],'post').Html::submitButton('<i class="icon-logout fa-fw"></i> Thoát ('.Yii::$app->user->identity->username.')',['class'=>'btn btn-link logout','style'=>'color: #ffffff;']).Html::endForm().'</li>';echo $menuItems; ?><li class="pull-right"><a href="javascript:void(0)"class="waves-effect"style="padding:6px 18px"><button class="right-side-toggle waves-effect waves-light btn-info btn-circle pull-right m-l-20"><i class="ti-settings text-white"></i></button></a></li></ul></div></div>