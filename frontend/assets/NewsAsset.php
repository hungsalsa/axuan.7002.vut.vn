<?php
namespace frontend\assets;
use yii\web\AssetBundle;
class NewsAsset extends AssetBundle
{
    public $css = [
        'font-awesome/css/all.min.css',
    ];
    public $js = [
        'bootstrap-4.4.1/js/bootstrap.min.js',
        'bootstrap-notify.min.js',
        'owlcarousel/owl.carousel.min.js',
        'hungsalsa.js',
        'main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        // 'yii\bootstrap4\BootstrapAsset',
    ];
}