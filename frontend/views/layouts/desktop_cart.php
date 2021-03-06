<?php

use yii\helpers\Html;
use frontend\assets\CartAsset;
use frontend\widgets\topHeader;
use frontend\widgets\mainMenu;
use frontend\widgets\footerWidget;

CartAsset::register($this); ?><?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta content="IE=edge"http-equiv="X-UA-Compatible">
    <meta content="width=device-width,initial-scale=1"name="viewport">
    <link rel="stylesheet" href="/frontend/web/main.css">
    <link rel="stylesheet" href="/frontend/web/change.css">
    <script src="https://www.google.com/recaptcha/api.js?hl=vi"async defer></script><?php echo Html::csrfMetaTags();
    $this->registerMetaTag(['name' => 'copyright', 'content' => 'mayin24h.vn']);
    $this->registerMetaTag(['name' => 'author', 'content' => 'mayin24h.vn']);
    $this->registerMetaTag(Yii::$app->params['og_site_name'], 'og_site_name');
    $this->registerMetaTag(Yii::$app->params['og_type'], 'og_type');
    $this->registerMetaTag(Yii::$app->params['og_locale'], 'og_locale');
     $this->head() ?>
    <link href="<?= Yii::$app->homeUrl ?>images/favicon.ico"rel="icon"sizes="16x16"type="image/ico">
    
</head>
<body>
    <?php $this->beginBody() ?>
    <header>
        <?= topHeader::widget() ?><?= mainMenu::widget() ?>
    </header>
    <section class="main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-1 col-xl-1"><div class="left"></div></div>
                <div class="col-lg-11 col-xl-11">
                <div id="cart"><div class="row">
                    <div class="col-lg-12 col-xl-12">
                        <h2 class="cart-h2">Thông tin đặt hàng</h2>
                    </div>
                    </div>
                    <div class="row"><?= $content ?></div>
                </div>
                </div>
            </div>
        </div>
    </section>
    <?= \frontend\widgets\modalDeleteCart::widget() ?>
    <?= footerWidget::widget() ?>
    <?php $this->endBody() ?>
    <?php if (Yii::$app->session->hasFlash('messeage')) {
        $messeage = Yii::$app->session->getFlash('messeage');
    }if (isset($messeage)): ?>
    <script type="text/javascript">$.notify({icon: "pe-7s-gift", message: "<?= $messeage ?>"}, {type: "info", timer: 500})</script>
    <?php endif; ?>
</body>
</html>
<?php $this->endPage() ?>