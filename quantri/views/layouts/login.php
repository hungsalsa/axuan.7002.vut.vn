<?php
ob_start();
use quantri\assets\LoginAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

LoginAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= Yii::$app->homeUrl ?>plugins/images/favicon.png">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="fix-header fix-sidebar card-no-border content-wrapper">
<?php $this->beginBody() ?>
    <!-- Preloader -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
            </div>
                <div class="col-md-8">
                    <img width="100%" src="<?= Yii::$app->homeUrl ?>plugins/images/login-register.jpg">
                </div>
                <div class="col-md-4">
                    <div class="white-box">
                        <?= $content ?>
                    </div>
                </div>
        </div>
    </div>
    


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();exit(); ?>