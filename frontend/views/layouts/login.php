<?php
use yii\helpers\Html;
use frontend\assets\AppAsset;
use frontend\widgets\topHeader;
use frontend\widgets\mainMenu;
use frontend\widgets\slideShow;
use frontend\widgets\customModulesIn;
use frontend\widgets\formIn;
use frontend\widgets\categoryFeatured;
use frontend\widgets\products\verticalProductMenus;
// use frontend\widgets\news\newsModule;
// use frontend\widgets\news\newsModuleMega;
// use frontend\widgets\brandsWidget;

use frontend\widgets\footerWidget;

AppAsset::register($this);

// echo $this->params['typeUser'];die;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <title><?= Html::encode($this->title)?></title>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php

    echo Html::csrfMetaTags();
    $this->registerMetaTag(['name' => 'copyright', 'content' => 'mayin24h.vn']);
    $this->registerMetaTag(['name' => 'author', 'content' => 'mayin24h.vn']);

    $this->registerMetaTag(Yii::$app->params['og_site_name'], 'og_site_name');
    $this->registerMetaTag(Yii::$app->params['og_type'], 'og_type');
    $this->registerMetaTag(Yii::$app->params['og_locale'], 'og_locale');
    // $this->registerMetaTag(Yii::$app->params['og_title'], 'og_title');
    // $this->registerMetaTag(Yii::$app->params['og_description'], 'og_description');
    // $this->registerMetaTag(Yii::$app->params['og_url'], 'og_url');
    // $this->registerMetaTag(Yii::$app->params['og_image'], 'og_image');

    $this->registerLinkTag(['rel' => 'canonical', 'href' => Yii::$app->request->absoluteUrl]);
    ?>
    <?php $this->head() ?>
    <link rel="icon" type="image/ico" sizes="16x16" href="<?=Yii::$app->homeUrl ?>images/favicon.ico">
    <style type="text/css">
    <?php include Yii::getAlias('@frontend').'/web/css/style_product.css';  include Yii::getAlias('@frontend').'/web/styles/mrxuan.css'; ?>
    </style>
</head>
<body>
    <?php $this->beginBody() ?>

            <header>
                <!-- TOP HEADER -->
                <?= topHeader::widget() ?>
                <!-- END: TOP HEADER -->

                <!-- MAIN HEADER -->
                <?= mainMenu::widget() ?>
                <!-- END: TOP HEADER -->
            </header>
            
            <section class="main" style="min-height: 500px;">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-2 col-xl-2">
                        <div class="left"></div>
                        </div>
                        <div class="col-lg-8 col-xl-8">
                            <div class="center inside" id="content">
                                <?= $content ?>
                            </div>
                        </div>
                        <?php if (isset(Yii::$app->params['settingModules']['content']['content_right'])): ?>
                            <div class="col-lg-2 col-xl-2">
                                <div class="right"></div>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
            </section>
            
            <?= footerWidget::widget() ?>
            <?= \frontend\widgets\modalCartWidget::widget() ?>
    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>
