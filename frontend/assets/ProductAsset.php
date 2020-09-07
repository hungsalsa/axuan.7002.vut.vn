<?php
namespace frontend\assets;
use yii\web\AssetBundle;
class ProductAsset extends AssetBundle
{
    public $css = [
        'font-awesome/css/all.min.css',
    ];
    public $js = [
        'jquery-3.4.1.min.js',
        'jquery-ui/jquery-ui.js',
        'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js',
        'bootstrap-4.4.1/js/bootstrap.min.js',
        'owlcarousel/owl.carousel.min.js',
        'bootstrap-notify.min.js',
        'hungsalsa.js',
        'main.js',
    ];
    public $depends = [
        // 'yii\web\YiiAsset',
        // 'yii\bootstrap\BootstrapAsset',
    ];
}