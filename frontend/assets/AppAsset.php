<?php
namespace frontend\assets;
use yii\web\AssetBundle;
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'font-awesome/css/all.min.css',
    ];
    public $js = [
        // 'js/jquery-3.4.1.min.js',
        'jquery-ui/jquery-ui.js',
        'bootstrap-4.4.1/js/bootstrap.min.js',
        'owlcarousel/owl.carousel.min.js',
        'bootstrap-notify.min.js',
        'hungsalsa.js',
        'main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        // 'yii\bootstrap\BootstrapAsset',
    ];
}