<?php

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\assets\ProductAsset;
use frontend\widgets\topHeader;
use frontend\widgets\mainMenu;
use frontend\widgets\slideShow;
use frontend\widgets\customModulesIn;
use frontend\widgets\formIn;
use frontend\widgets\categoryFeatured;
use frontend\widgets\products\verticalProductMenus;
use frontend\widgets\footerWidget;

ProductAsset::register($this); ?><?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta content="IE=edge"http-equiv="X-UA-Compatible">
    <meta content="width=device-width,initial-scale=1"name="viewport">
    <link rel="stylesheet" href="/frontend/web/main.css">
    <link rel="stylesheet" href="/frontend/web/change.css">
    <link rel="stylesheet" href="/frontend/web/css/hung.css">
    <?php echo Html::csrfMetaTags();
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
<header>
<?= topHeader::widget() ?><?= mainMenu::widget() ?>
</header>
<section class="main">
<div class="container-fluid"><div class="row">
    <?php if (Yii::$app->params['layout'] != '_mobile'): ?>
<div class="col-lg-2 col-xl-2">
<?php if (isset(Yii::$app->params['settingModules']['content']['content_left'])): ?>
     
<div class="left">
<?php foreach (Yii::$app->params['settingModules']['content']['content_left']as $value): ?><?php switch ($value['type_module']) {
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
        } ?><?php endforeach ?></div>
           
    
    <?php endif ?></div><?php endif ?><div class="col-lg-8 col-xl-8"><div class="center inside"id="content"><?= $content ?><?php $content_center = isset(Yii::$app->params['settingModules']['content']['content_center']) ? Yii::$app->params['settingModules']['content']['content_center'] : null;
if ($content_center) {
    foreach ($content_center as $value) {
        if ($value['type_module'] == 'custom') {
            echo frontend\widgets\customModulesIn::widget(['content' => $value['content']]);
        } elseif ($value['type_module'] == 'form') {
            echo frontend\widgets\formIn::widget(['name' => $value['name'], 'content' => $value['content']]);
        } elseif ($value['type_module'] == 'product') {
            switch ($value['hienthi']) {
                case 'product_1':echo frontend\widgets\products\product_1_Widget::widget(['data' => $value]);
                    break;
                case 'product_2':echo frontend\widgets\products\product_2_Widget::widget(['data' => $value]);
                    break;
                default:echo frontend\widgets\products\product_3_Widget::widget(['data' => $value]);
                    break;
            }
        } else {
            switch ($value['hienthi']) {
                case 'new_2':echo frontend\widgets\news\newsModule_2::widget(['model' => $value]);
                    break;
                case 'new_3':echo frontend\widgets\news\newsModule_3::widget(['model' => $value]);
                    break;
                case 'new_4':echo frontend\widgets\news\newsModule_4::widget(['model' => $value]);
                    break;
                default:echo frontend\widgets\news\newsModule_1::widget(['model' => $value]);
                    break;
            }
        }
    }
} ?></div></div><?php if (isset(Yii::$app->params['settingModules']['content']['content_right'])): ?><div class="col-lg-2 col-xl-2"><div class="right"><?php foreach (Yii::$app->params['settingModules']['content']['content_right']as $value): ?><?php switch ($value['type_module']) {
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
        } ?><?php endforeach ?></div></div><?php endif ?></div></div></section><?= footerWidget::widget() ?><?= \frontend\widgets\modalCartWidget::widget() ?><?php $this->endBody() ?><?php if (Yii::$app->session->hasFlash('messeage')) {
    $messeage = Yii::$app->session->getFlash('messeage');
}if (isset($messeage)): ?><script type="text/javascript">$.notify({icon: "pe-7s-gift", message: "<?= $messeage ?>"}, {type: "info", timer: 500})</script><?php endif; ?></body></html><?php $this->endPage() ?>