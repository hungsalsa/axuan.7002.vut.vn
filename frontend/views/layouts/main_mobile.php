<?php

use yii\helpers\Html;
use frontend\assets\AppAsset;
use frontend\widgets\topHeaderMobile;
use frontend\widgets\mainMenu;
use frontend\widgets\slideShow;
use frontend\widgets\customModulesIn;
use frontend\widgets\formIn;
use frontend\widgets\modalCartWidget;
use frontend\widgets\categoryFeatured;
use frontend\widgets\products\verticalProductMenus;
use frontend\widgets\footerWidget;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head><title>
        <?= Html::encode($this->title) ?></title>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta content="IE=edge"http-equiv="X-UA-Compatible">
        <meta content="width=device-width,initial-scale=1"name="viewport">
        <link rel="stylesheet" href="/frontend/web/main.css">
        <link rel="stylesheet" href="/frontend/web/change.css">
        <script src="https://www.google.com/recaptcha/api.js?hl=vi"async defer></script>
        <?php
        echo Html::csrfMetaTags();
        $this->registerMetaTag(['name' => 'copyright', 'content' => 'mayin24h.vn']);
        $this->registerMetaTag(['name' => 'author', 'content' => 'mayin24h.vn']);
        $this->registerMetaTag(Yii::$app->params['og_site_name'], 'og_site_name');
        $this->registerMetaTag(Yii::$app->params['og_type'], 'og_type');
        $this->registerMetaTag(Yii::$app->params['og_locale'], 'og_locale');
        ?>
        <?php $this->head() ?>
        <link href="<?= Yii::$app->homeUrl ?>images/favicon.ico"rel="icon"sizes="16x16"type="image/ico">
    </head>
    <body>
        <?php $this->beginBody() ?>
        <header id="layouts_main_mobile">
            <?= topHeaderMobile::widget() ?>
            <?= mainMenu::widget() ?>
        </header>
        <div id="layouts_main_mobile" class="slideshow"><?= slideShow::widget() ?></div>
        <div id="layouts_main_mobile" class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 col-xl-8">
                        <div class="center"id="content"><?= $content ?></div>
                    </div>
                    <div class="col-lg-2 col-xl-2">
                        <div class="right">
                            <?php if (isset(Yii::$app->params['settingModules']['content']['content_right'])): ?>
                            <?php foreach (Yii::$app->params['settingModules']['content']['content_right']as $value): ?>
                            <?php
                                switch ($value['type_module']) {
                                    case 'custom':echo customModulesIn::widget(['content' => $value['content']]);
                                        break;
                                    case 'form':echo frontend\widgets\formIn::widget(['name' => $value['name'], 'content' => $value['content']]);
                                        break;
                                    case 'news': {
                                            switch ($value['hienthi']) {
                                                case 'new_1':echo \frontend\widgets\news\verticalNewMenus::widget(['data' => $value]);
                                                    break;
                                                default: {
                                                    echo \frontend\widgets\news\megaNewMenus::widget(['data' => $value]);
                                                    break;
                                                }
                                            }
                                        }break;
                                    default:echo verticalProductMenus::widget(['data' => $value]);
                                        break;
                                }
                            ?>
                            <?php endforeach ?><?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="layouts_main_mobile"><?= footerWidget::widget() ?><?= modalCartWidget::widget() ?></div>
        <?php $this->endBody() ?>
        <?php
            if (Yii::$app->session->hasFlash('messeage')) {
                    $messeage = Yii::$app->session->getFlash('messeage');
            }
            if (isset($messeage)):
        ?>
        <script type="text/javascript">$.notify({icon: "pe-7s-gift", message: "<?= $messeage ?>"}, {type: "info", timer: 500})</script>
        <?php endif; ?>
    </body>
</html>
<?php $this->endPage() ?>