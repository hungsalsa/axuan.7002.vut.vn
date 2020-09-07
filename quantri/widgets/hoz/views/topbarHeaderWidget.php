<?php 
use yii\helpers\Html;
use yii\helpers\Url;
?>
<nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header">
                <div class="top-left-part" style="text-align:center">
                    <!-- Logo -->
                    <a class="logo" style="color:red;font-weight:bold;" href="<?= Yii::$app->homeUrl ?>">Admin GGO</a>
                </div>
                <!-- /Logo -->
                <!-- Search input and Toggle icon -->
                <ul class="nav navbar-top-links navbar-left">
                    <li><a href="javascript:void(0)" class="open-close waves-effect waves-light visible-xs"><i class="ti-close ti-menu"></i></a></li>
                </ul>

                <ul class="nav navbar-top-links navbar-right pull-right">
                    <li>
                        <a href="<?= Yii::$app->request->hostInfo ?>" target="_blank"><span class="hide-menu text-info"><span class="hidden-xs">Xem Website</span></span></a>
                    </li>
                    <li>
                        <form role="search" class="app-search hidden-sm hidden-xs m-r-10">
                            <input type="text" placeholder="Search..." class="form-control"> <a href=""><i class="fa fa-search"></i></a> </form>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"><b class="hidden-xs"><?= (isset(getUser()->id))? getUser()->username: 'Steave' ?></b><span class="caret"></span> </a>
                        <ul class="dropdown-menu dropdown-user animated flipInY">
                            <!--<li>-->
                            <!--    <div class="dw-user-box">-->
                            <!--        <div class="u-img"><img src="<?//= Yii::$app->homeUrl ?>plugins/images/users/varun.jpg" alt="user" /></div>-->
                            <!--        <div class="u-text">-->
                            <!--            <h4><?//= (isset(getUser()->id))? getUser()->username: 'Steave Jobs' ?></h4>-->
                            <!--            <p class="text-muted"><?//=  getUser()->email ?></p><a href="profile.html" class="btn btn-rounded btn-danger btn-sm">View Profile</a></div>-->
                            <!--    </div>-->
                            <!--</li>-->
                            <!--<li role="separator" class="divider"></li>-->
                            <!--<li><a href="<?//= Yii::$app->homeUrl ?>"><i class="ti-user"></i> My Profile</a></li>-->
                            <li><a href="<?= Yii::$app->homeUrl ?>user/changepassword"><i class="ti-wallet"></i> Đổi mật khẩu</a></li>
                            <!-- <li><a href="#"><i class="ti-email"></i> Inbox</a></li> -->
                            <li role="separator" class="divider"></li>
                            <!--<li><a href="<?//= Yii::$app->homeUrl ?>user"><i class="ti-settings"></i> Account Manager</a></li>-->
                            <?php 
                            $menuItems = '<li>'
                            . Html::beginForm(['/site/logout'], 'post')
                            . Html::submitButton(
                                '<i class="icon-logout fa-fw"></i> Logout (' . Yii::$app->user->identity->username . ')',
                                ['class' => 'btn btn-link logout']
                            )
                            . Html::endForm()
                            . '</li>';
                            echo $menuItems;
                            ?>                            
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                </ul>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>