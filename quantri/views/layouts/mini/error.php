<?php
use quantri\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use quantri\widgets\navbarHeaderErrorWidget;
use quantri\widgets\rightSidebarWidget;
// use Yii; 
// use quantri\widgets\RightSidebarWidget;
// use quantri\widgets\FooterWidget;

AppAsset::register($this);
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
        <?= navbarHeaderErrorWidget::widget() ?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <?= $content ?>
                <?= rightSidebarWidget::widget() ?>
            </div>
        </div>
        <footer class="footer text-center"> Admin </footer>
    </div>

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
        timer: 1200
    });
</script>
<?php endif; ?>

</body>
</html>
<?php $this->endPage();exit(); ?>