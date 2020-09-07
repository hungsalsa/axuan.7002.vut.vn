<?php

use quantri\assets\Main_jqueryAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use quantri\widgets\navbarWidget;
use quantri\widgets\navbarHeaderWidget;
// use quantri\widgets\RightSidebarWidget;
// use quantri\widgets\FooterWidget;

Main_jqueryAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="description" content="Philbert is a Dashboard & Admin Site Responsive Template by hencework." />
    <meta name="keywords" content="admin, admin dashboard, admin template, cms, crm, Philbert Admin, Philbertadmin, premium admin templates, responsive admin, sass, panel, software, ui, visualization, web app, application" />
    <meta name="author" content="hencework"/>
    
    <link rel="shortcut icon" href="<?=Yii::$app->homeUrl ?>favicon.ico">
    <link rel="icon" type="image/png" sizes="16x16" href="<?=Yii::$app->homeUrl ?>plugins/images/favicon.png">


    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="fix-header fix-sidebar card-no-border">
    
<?php $this->beginBody() ?>
    <!-- Preloader -->
    <!-- <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div> -->
    <div id="wrapper">
        <!-- Navigation -->
        <?= navbarWidget::widget() ?>

        <!-- Left navbar-header -->
        <?= navbarHeaderWidget::widget() ?>
        <!-- Left navbar-header end -->

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <?= $content ?>
            </div>
        </div>
        <footer class="footer text-center"> Admin </footer>
        <!-- /#page-wrapper -->
    </div>
         <!-- /#wrapper -->


<!-- sample modal content -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myLargeModalLabel">Quản lý ảnh</h4> </div>
            <div class="modal-body">
                <?php 
                $user =  Yii::$app->user->identity->username;
                $auth_key =  Yii::$app->user->identity->auth_key;
                ?>
                <iframe  width="100%" height="450" frameborder="0"
                    src="../../../filemanager/dialog.php?type=1&field_id=imageFile&lang=en_EN&akey=<?= md5($user.$auth_key) ?>">
                </iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div> 




<?php $this->endBody() ?>
<?php if(Yii::$app->session->hasFlash('messeage')): ?>
<script type="text/javascript">
    // demo.initChartist();

    $.notify({
        icon: 'pe-7s-gift',
        message: "<?= Yii::$app->session->getFlash('messeage') ?>"

    },{
        type: 'info',
        timer: 1200
    });
</script>
<?php endif; ?>
</body>
</html>
<?php $this->endPage();exit(); ?>