<?php use yii\helpers\Html; use yii\helpers\Url;?>
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav">
        <div class="sidebar-head">
            <h3><span class="fa-fw open-close"><i class="ti-menu hidden-xs"></i><i class="ti-close visible-xs"></i></span> <span class="hide-menu">Menu chính</span></h3>
        </div>
        <ul class="nav" id="side-menu">
            <li> <a href="javascript:void(0)" class="waves-effect"><span class="hide-menu">Sản phẩm<span class="fa arrow"></span> <span class="label label-rouded label-info pull-right">20</span> </span></a>
                <ul class="nav nav-second-level">
                    <li><a href="<?= Url::to(['/products/default'],true) ?>"><span class="hide-menu">Quản lý sản phẩm</span></a></li>
                    <li><a href="<?= Url::to(['/products/thuoctinhsp'],true) ?>"><span class="hide-menu">Quản lý thuộc tính</span></a></li>
                    <li><a href="<?= Url::to(['/products/productcategory'],true) ?>"><span class="hide-menu">Quản lý danh mục</span></a></li>
                    <li><a href="<?= Url::to(['/tags/index'],true) ?>"><span class="hide-menu">Danh sách Tag</span></a></li>
                    <!-- <li><a href="grid.html"><i data-icon="&#xe009;" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Grid</span></a></li>
                    <li><a href="tabs.html"><i  class="ti-layers fa-fw"></i> <span class="hide-menu">Tabs</span></a></li>
                    <li><a href="tab-stylish.html"><i class=" ti-layers-alt fa-fw"></i> <span class="hide-menu">Stylish Tabs</span></a></li>
                    <li><a href="modals.html"><i data-icon="&#xe026;" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Modals</span></a></li>
                    <li><a href="progressbars.html"><i class="ti-line-double fa-fw"></i> <span class="hide-menu">Progress Bars</span></a></li>
                    <li><a href="notification.html"><i class="ti-info-alt fa-fw"></i> <span class="hide-menu">Notifications</span></a></li>
                    <li><a href="carousel.html"><i class="ti-layout-slider fa-fw"></i> <span class="hide-menu">Carousel</span></a></li>
                    <li><a href="list-style.html"><i data-icon="&#xe00b;" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">List & Media object</span></a></li>
                    <li><a href="user-cards.html"><i class="ti-user fa-fw"></i> <span class="hide-menu">User Cards</span></a></li>
                    <li><a href="timeline.html"><i data-icon="/" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Timeline</span></a></li>
                    <li><a href="timeline-horizontal.html"><i class="ti-layout-list-thumb fa-fw"></i> <span class="hide-menu">Horizontal Timeline</span></a></li>
                    <li><a href="nestable.html"><i class="ti-layout-accordion-separated fa-fw"></i> <span class="hide-menu">Nesteble</span></a></li>
                    <li><a href="range-slider.html"><i class=" ti-layout-slider-alt fa-fw"></i> <span class="hide-menu">Range Slider</span></a></li>
                    <li><a href="tooltip-stylish.html"><i class="ti-comments-smiley fa-fw"></i> <span class="hide-menu">Stylish Tooltip</span></a></li>
                    <li><a href="bootstrap.html"><i class="ti-rocket fa-fw"></i> <span class="hide-menu">Bootstrap UI</span></a></li> -->
                </ul>
            </li>
            <li> <a href="javascript:void(0)" class="waves-effect"><span class="hide-menu">Tin tức<span class="fa arrow"></span></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="<?= Url::to(['/news/default'],true) ?>"><span class="hide-menu">Quản lý tin tức</span></a></li>
                    <li>
                        <a href="<?= Url::to(['/news/downloads'],true) ?>"><span class="hide-menu">Quản lý downloads</span><span class="fa arrow"></span></a>
                        <ul>
                            <li> <a href="<?= Url::to(['/news/downloads'],true) ?>"><span class="hide-menu">Danh sách</span></a></li>
                            <li> <a href="<?= Url::to(['/news/categories/downloads'],true) ?>"><span class="hide-menu">Danh mục</span></a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="waves-effect"><span class="hide-menu">Quản lý albums</span></a> <span class="fa arrow"></span></a>
                        <ul>
                            <li> <a href="<?= Url::to(['/news/album'],true) ?>"><span class="hide-menu">Danh sách</span></a></li>
                            <li> <a href="<?= Url::to(['/news/categories/albums'],true) ?>"><span class="hide-menu">Danh mục</span></a></li>
                        </ul>
                    <li><a href="<?= Url::to(['/news/categories'],true) ?>"><span class="hide-menu">Quản lý danh mục</span></a></li>
                    <!-- <li><a href="form-layout.html"><i class="fa-fw">L</i><span class="hide-menu">Form Layout</span></a></li>
                    <li><a href="form-advanced.html"><i class="fa-fw">A</i><span class="hide-menu">Form Addons</span></a></li>
                    <li><a href="form-material-elements.html"><i class="fa-fw">M</i><span class="hide-menu">Form Material</span></a></li>
                    <li><a href="form-float-input.html"><i class="fa-fw">F</i><span class="hide-menu">Form Float Input</span></a></li>
                    <li><a href="form-upload.html"><i class="fa-fw">U</i><span class="hide-menu">File Upload</span></a></li>
                    <li><a href="form-mask.html"><i class="fa-fw">M</i><span class="hide-menu">Form Mask</span></a></li>
                    <li><a href="form-img-cropper.html"><i class="fa-fw">C</i><span class="hide-menu">Image Cropping</span></a></li>
                    <li><a href="form-validation.html"><i class="fa-fw">V</i><span class="hide-menu">Form Validation</span></a></li>
                    <li><a href="form-dropzone.html"><i class="fa-fw">D</i><span class="hide-menu">File Dropzone</span></a></li>
                    <li><a href="form-pickers.html"><i class="fa-fw">P</i><span class="hide-menu">Form-pickers</span></a></li>
                    <li><a href="form-wizard.html"><i class="fa-fw">W</i><span class="hide-menu">Form-wizards</span></a></li>
                    <li><a href="form-typehead.html"><i class="fa-fw">T</i><span class="hide-menu">Typehead</span></a></li>
                    <li><a href="form-xeditable.html"><i class="fa-fw">X</i><span class="hide-menu">X-editable</span></a></li>
                    <li><a href="form-summernote.html"><i class="fa-fw">S</i><span class="hide-menu">Summernote</span></a></li>
                    <li><a href="form-bootstrap-wysihtml5.html"><i class=" fa-fw">W</i><span class="hide-menu">Bootstrap wysihtml5</span></a></li>
                    <li><a href="form-tinymce-wysihtml5.html"><i class="fa-fw">T</i><span class="hide-menu">Tinymce wysihtml5</span></a></li> -->
                </ul>
            </li>
            <li> <a href="javascript:void(0)" class="waves-effect"><span class="hide-menu">Cài đặt<span class="fa arrow"></span></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="<?= Url::to(['/setting/menus'],true) ?>"><span class="hide-menu">Quản lý menus</span></a></li>
                    <li><a href="<?= Url::to(['/setting/setting-modules'],true) ?>"><span class="hide-menu">Quản lý modules</span></a></li>
                    <li><a href="<?= Url::to(['/setting/banner'],true) ?>"><span class="hide-menu">Slideshow</span></a></li>
                    <li><a href="<?= Yii::$app->homeUrl ?>setting/settingbrands"><span class="hide-menu">Logo đối tác</span></a></li>
                    <li><a href="<?= Yii::$app->homeUrl ?>setting/default/update?id=1"><span class="hide-menu">Thông tin website</span></a></li>
                    <!-- <li><a href="<?= Yii::$app->homeUrl ?>setting/settingcategories"><i class="ti-layout-sidebar-left fa-fw"></i> <span class="hide-menu">Sidebar Danh mục</span></a></li> -->
                    <!-- <li><a href="<?= Yii::$app->homeUrl ?>setting/settingcategory"><i class="ti-layout-sidebar-right fa-fw"></i> <span class="hide-menu">Setting Category</span></a></li> -->
                    <!-- <li><a href="<?= Yii::$app->homeUrl ?>setting" class="waves-effect"><i class="ti-folder fa-fw"></i> <span class="hide-menu">Khác</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-third-level">
                        <li> <a href="<?= Yii::$app->homeUrl ?>setting/settingtabs"><i class="fa-fw">T</i> <span class="hide-menu">Cài Tabs trang chủ</span></a></li>
                    </ul>
                    </li> -->
                </ul>
            </li>
            <li> <a href="javascript:void(0)" class="waves-effect"><span class="hide-menu">Liên hệ<span class="fa arrow"></span> <span class="label label-rouded label-info pull-right">20</span> </span></a>
                <ul class="nav nav-second-level">
                    <li><a href="<?= Url::to(['/products/order'],true) ?>"><span class="hide-menu">Đơn hàng</span></a></li>
                    <li><a href="<?= Url::to(['/customer/customer'],true) ?>"><span class="hide-menu">Khách liên hệ</span></a></li>
                    <li><a href="<?= Url::to(['/customer/contacts'],true) ?>"><span class="hide-menu">Hội viên mới</span></a></li>
                    <!-- <li><a href="tabs.html"><i  class="ti-layers fa-fw"></i> <span class="hide-menu">Tabs</span></a></li>
                    <li><a href="tab-stylish.html"><i class=" ti-layers-alt fa-fw"></i> <span class="hide-menu">Stylish Tabs</span></a></li>
                    <li><a href="modals.html"><i data-icon="&#xe026;" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Modals</span></a></li>
                    <li><a href="progressbars.html"><i class="ti-line-double fa-fw"></i> <span class="hide-menu">Progress Bars</span></a></li>
                    <li><a href="notification.html"><i class="ti-info-alt fa-fw"></i> <span class="hide-menu">Notifications</span></a></li>
                    <li><a href="carousel.html"><i class="ti-layout-slider fa-fw"></i> <span class="hide-menu">Carousel</span></a></li>
                    <li><a href="list-style.html"><i data-icon="&#xe00b;" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">List & Media object</span></a></li>
                    <li><a href="user-cards.html"><i class="ti-user fa-fw"></i> <span class="hide-menu">User Cards</span></a></li>
                    <li><a href="timeline.html"><i data-icon="/" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Timeline</span></a></li>
                    <li><a href="timeline-horizontal.html"><i class="ti-layout-list-thumb fa-fw"></i> <span class="hide-menu">Horizontal Timeline</span></a></li>
                    <li><a href="nestable.html"><i class="ti-layout-accordion-separated fa-fw"></i> <span class="hide-menu">Nesteble</span></a></li>
                    <li><a href="range-slider.html"><i class=" ti-layout-slider-alt fa-fw"></i> <span class="hide-menu">Range Slider</span></a></li>
                    <li><a href="tooltip-stylish.html"><i class="ti-comments-smiley fa-fw"></i> <span class="hide-menu">Stylish Tooltip</span></a></li>
                    <li><a href="bootstrap.html"><i class="ti-rocket fa-fw"></i> <span class="hide-menu">Bootstrap UI</span></a></li> -->
                </ul>
            </li>
            <?php 
            $menuItems = '<li style="height: 42px;line-height: 42px;">'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                '<i class="icon-logout fa-fw"></i> Thoát (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout','style'=>'color: #ffffff;']
            )
            . Html::endForm()
            . '</li>';
            echo $menuItems;
            ?> 
            
            <li class="pull-right">
                <a href="javascript:void(0)" class="waves-effect" style='padding: 6px 18px;'>
                <button class="right-side-toggle waves-effect waves-light btn-info btn-circle pull-right m-l-20"><i class="ti-settings text-white"></i></button>
                </a>
            </li>
        </ul>
    </div>
</div>