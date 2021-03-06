<?php

use yii\helpers\Html;
use frontend\assets\AlbumAsset;
use frontend\widgets\topHeader;
use frontend\widgets\mainMenu;
use frontend\widgets\slideShow;
use frontend\widgets\customModulesIn;
use frontend\widgets\formIn;
use frontend\widgets\categoryFeatured;
use frontend\widgets\products\verticalProductMenus;
use frontend\widgets\footerWidget;

AlbumAsset::register($this); ?><?php $this->beginPage() ?><!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta content="IE=edge"http-equiv="X-UA-Compatible">
    <meta content="width=device-width,initial-scale=1"name="viewport">
    <?php echo Html::csrfMetaTags();
    $this->registerMetaTag(['name' => 'copyright', 'content' => 'lopxin.com']);
    $this->registerMetaTag(['name' => 'author', 'content' => 'lopxin.com']);
    $this->registerMetaTag(['name' => 'robots', 'content' => 'INDEX,FOLLOW']);
    $this->registerMetaTag(Yii::$app->params['og_site_name'], 'og_site_name');
    $this->registerMetaTag(Yii::$app->params['og_type'], 'og_type');
    $this->registerMetaTag(Yii::$app->params['og_locale'], 'og_locale');
     $this->head() ?>
    <link rel="stylesheet" href="/frontend/web/main.css">
    <link rel="stylesheet" href="/frontend/web/change.css">
    <link href="<?= Yii::$app->homeUrl ?>images/favicon.ico"rel="icon"sizes="16x16"type="image/ico">
</head>
<body class="fotorama-style-contain"><?php $this->beginBody() ?>
    <header><?= topHeader::widget() ?><?= mainMenu::widget() ?></header>
    <section class="main">
        <div class="container-fluid">
            <div class="row">
                <?php if (Yii::$app->params['layout'] != '_mobile'): ?>
                <div class="col-lg-2 col-xl-2">
                    <?php if (isset(Yii::$app->params['settingModules']['content']['content_left'])): ?>
                    <div class="left">
                        <?php foreach (Yii::$app->params['settingModules']['content']['content_left']as $value): ?>
                        <?php switch ($value['type_module']) {
                            case 'custom':echo customModulesIn::widget(['content' => $value['content']]);
                                break;
                            case 'form':echo frontend\widgets\formIn::widget(['name' => $value['name'], 'content' => $value['content']]);
                                break;
                            case 'news':switch ($value['hienthi']) {
                                    case 'new_1':echo \frontend\widgets\news\verticalNewMenus::widget(['data' => $value]);
                                        break;
                                    default:echo \frontend\widgets\news\megaNewMenus::widget(['data' => $value]);
                                        break;
                                }break;
                            default:echo verticalProductMenus::widget(['data' => $value]);
                                break;
                        } ?>
                    <?php endforeach ?>
                    </div>
                    <?php endif ?>
                </div>
                <?php endif ?>
                <div class="col-lg-8">
                    <div class="albums center"><?= $content ?></div>
                </div>
                <?php if (isset(Yii::$app->params['settingModules']['content']['content_right'])): ?>
                <div class="col-lg-2 col-xl-2"><div class="right">
                <?php foreach (Yii::$app->params['settingModules']['content']['content_right']as $value): ?>
                <?php switch ($value['type_module']) {
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
                } ?>
                <?php endforeach ?></div></div>
                <?php endif ?>
            </div>
        </div>
    </section>
    <?= footerWidget::widget() ?>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>