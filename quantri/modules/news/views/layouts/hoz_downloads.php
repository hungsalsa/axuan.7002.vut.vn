<?php
use quantri\assets\Hoz_AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
// use common\widgets\Alert;
use quantri\widgets\hoz\topbarHeaderWidget;
use quantri\widgets\hoz\navbarSidebarWidget;
use quantri\widgets\rightSidebarWidget;
// use Yii; 
// use quantri\widgets\RightSidebarWidget;
// use quantri\widgets\FooterWidget;

Hoz_AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <!-- <link rel="shortcut icon" href="<?=Yii::$app->homeUrl ?>favicon.ico"> -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?=Yii::$app->homeUrl ?>plugins/images/favicon.png">


    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="fix-header">
    
<?php $this->beginBody() ?>
    <!-- Preloader -->
    <!-- <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div> -->
    <div id="wrapper">
         <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <?= topbarHeaderWidget::widget() ?>

        <!-- End Top Navigation -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <?= navbarSidebarWidget::widget() ?>
        <!-- ============================================================== -->
        <!-- End Left Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <?= $content ?>
                <?= rightSidebarWidget::widget() ?>
            </div>
        </div>
        <!-- /.container-fluid -->
        <footer class="footer text-center"> Admin </footer>
        <!-- ============================================================== -->
        <!-- End Page Content -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
<?php $action = Yii::$app->controller->action->id; if ($action == 'create' || $action == 'update'): ?>
<!-- sample modal content -->
<div class="modal modalmain fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title text-center" id="myLargeModalLabel">Quản lý ảnh</h4> </div>
            <div class="modal-body">
                <?php 
                $user =  Yii::$app->user->identity->username;
                $auth_key =  Yii::$app->user->identity->auth_key;
                ?>
                <iframe  width="100%" height="450" frameborder="0"
                    src="../../../filemanager/dialog.php?type=2&field_id=imageFile&lang=en_EN&akey=<?= md5($user.$auth_key) ?>">
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
<?php endif ?>


<?php $this->endBody() ?>

<?php 
if(Yii::$app->session->hasFlash('messeage')){
    $messeage = Yii::$app->session->getFlash('messeage');
}
if(isset($messeage)): 
    ?>
<script type="text/javascript">
    $.notify({
        icon: 'pe-7s-gift',
        message: "<?= $messeage ?>"

    },{
        type: 'info',
        timer: 200
    });
</script>
<?php endif; ?>

</body>
</html>
<?php $this->endPage();exit(); ?>