<?php use yii\helpers\Html;  ?>
<div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav slimscrollsidebar">
                <div class="sidebar-head">
                    <h3><span class="fa-fw open-close"><i class="ti-menu hidden-xs"></i><i class="ti-close visible-xs"></i></span> <span class="hide-menu">Navigation</span></h3> </div>
                <ul class="nav" id="side-menu">
                    <!-- <li class="user-pro">
                        <a href="#" class="waves-effect"><img src="<?= Yii::$app->homeUrl ?>plugins/images/users/varun.jpg" alt="user-img" class="img-circle"> <span class="hide-menu"> Steve Gection<span class="fa arrow"></span></span>
                        </a>
                        <ul class="nav nav-second-level collapse" aria-expanded="false" style="height: 0px;">
                            <li><a href="javascript:void(0)"><i class="ti-user"></i> <span class="hide-menu">My Profile</span></a></li>
                            <li><a href="javascript:void(0)"><i class="ti-wallet"></i> <span class="hide-menu">My Balance</span></a></li>
                            <li><a href="javascript:void(0)"><i class="ti-email"></i> <span class="hide-menu">Inbox</span></a></li>
                            <li><a href="javascript:void(0)"><i class="ti-settings"></i> <span class="hide-menu">Account Manager</span></a></li>
                            <li><a href="javascript:void(0)"><i class="fa fa-power-off"></i> <span class="hide-menu">Logout</span></a></li>
                        </ul>
                    </li> -->
                    <li> <a href="<?= Yii::$app->homeUrl ?>quantri/product" class="waves-effect"><i class="icon icon-trophy fa-fw" data-icon="v"></i><span class="hide-menu">Sản phẩm<span class="fa arrow"></span><span class="label label-rouded label-inverse pull-right">4</span></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="<?= Yii::$app->homeUrl ?>products/product"><i class=" fa-fw">1</i><span class="hide-menu"> Sản phẩm </span></a> </li>
                            <li> <a href="<?= Yii::$app->homeUrl ?>products/productcategory"><i class=" fa-fw">1</i><span class="hide-menu"> Danh mục sản phẩm </span></a> </li>
                            <li> <a href="<?= Yii::$app->homeUrl ?>products/producttype"><i class=" fa-fw">2</i><span class="hide-menu">Loại sản phẩm</span></a> </li>
                            <li> <a href="index3.html"><i class=" fa-fw">3</i><span class="hide-menu">Dashboard 3</span></a> </li>
                        </ul>
                    </li>
                    <li> <a href="#" class="waves-effect"><i class="icon icon-layers fa-fw"></i> <span class="hide-menu">Tin tức<span class="fa arrow"></span> <span class="label label-rouded label-info pull-right">20</span> </span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?= Yii::$app->homeUrl ?>quantri/news"><i data-icon="&#xe026;" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Tin tức</span></a></li>
                            <li><a href="<?= Yii::$app->homeUrl ?>quantri/categories"><i data-icon="&#xe025;" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Danh mục tin tức</span></a></li>
                            <li><a href="<?= Yii::$app->homeUrl ?>quantri/group"><i class="ti-layout-menu fa-fw"></i> <span class="hide-menu">Nhóm danh mục</span></a></li>
                            
                        </ul>
                    </li>
                    <li> <a href="#" class="waves-effect"><i data-icon="a" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Quản lý khác<span class="fa arrow"></span> <span class="label label-rouded label-info pull-right">20</span> </span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?= Yii::$app->homeUrl ?>quantri/models"><i data-icon="&#xe026;" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Danh sách xe</span></a></li>
                            <li><a href="<?= Yii::$app->homeUrl ?>quantri/manufactures"><i data-icon="&#xe025;" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Nhà sản xuất</span></a></li>
                            <li><a href="<?= Yii::$app->homeUrl ?>quantri/pages"><i class="ti-layout-menu fa-fw"></i> <span class="hide-menu">Trang nội dung</span></a></li>
                            <li><a href="<?= Yii::$app->homeUrl ?>other/attribute"><i class="ti-alert fa-fw"></i> <span class="hide-menu">Thuộc tính</span></a></li>
                            <li><a href="<?= Yii::$app->homeUrl ?>quantri/attributes"><i data-icon="k" class="linea-icon linea-software fa-fw"></i> <span class="hide-menu">Giá trị thuộc tính</span></a></li>
                            
                        </ul>
                    </li>
                    
                    <li> <a href="?= Yii::$app->homeUrl ?>setting" class="waves-effect"><i data-icon="P" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Cài đặt Website<span class="fa arrow"></span><span class="label label-rouded label-warning pull-right">30</span></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?= Yii::$app->homeUrl ?>setting/menus"><i class="ti-layout-width-default fa-fw"></i> <span class="hide-menu">Menus Web</span></a></li>
                            <li><a href="<?= Yii::$app->homeUrl ?>setting/banner"><i class=" ti-layers fa-fw"></i> <span class="hide-menu">Banner Website</span></a></li>
                            <li><a href="<?= Yii::$app->homeUrl ?>setting/settingcategories"><i class="ti-layout-sidebar-left fa-fw"></i> <span class="hide-menu">Sidebar Danh mục</span></a></li>
                            <li><a href="<?= Yii::$app->homeUrl ?>setting/settingcategory"><i class="ti-layout-sidebar-right fa-fw"></i> <span class="hide-menu">Setting Category</span></a></li>
                            <li><a href="<?= Yii::$app->homeUrl ?>setting/settingbrands"><i class=" ti-apple fa-fw"></i> <span class="hide-menu">Nhãn hiệu</span></a></li>
                            <li><a href="<?= Yii::$app->homeUrl ?>setting/default/update?id=1"><i class=" ti-apple fa-fw"></i> <span class="hide-menu">Thông tin website</span></a></li>
                            <li><a href="<?= Yii::$app->homeUrl ?>setting" class="waves-effect"><i class="ti-folder fa-fw"></i> <span class="hide-menu">Khác</span><span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li> <a href="<?= Yii::$app->homeUrl ?>setting/settingtabs"><i class="fa-fw">T</i> <span class="hide-menu">Cài Tabs trang chủ</span></a></li>
                                    <li> <a href="<?= Yii::$app->homeUrl ?>setting/setting-modules"><i class="fa-fw">T</i> <span class="hide-menu">Cài đặt Module sản phẩm</span></a></li>
                                </ul>
                            </li>
                            <li><a href="javascript:void(0)" class="waves-effect"><i class="ti-lock fa-fw"></i><span class="hide-menu">Authentication</span><span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li><a href="login.html"><i class="fa-fw">L</i> <span class="hide-menu">Login Page</span></a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><?= Html::a('<i class="mdi mdi-logout fa-fw"></i> <span class="hide-menu">Log out</span>', Yii::$app->homeUrl.'site/logout',['data-method' => 'post','class'=>'waves-effect']) ?></li>
                    <li class="devider"></li>
                </ul>
            </div>
        </div>