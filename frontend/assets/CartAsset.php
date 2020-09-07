<?php
namespace frontend\assets;
use yii\web\AssetBundle;
class CartAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'font-awesome/css/all.min.css',
    ];
    public $js = [
        'bootstrap-4.4.1/js/bootstrap.min.js',
        'bootstrap-notify.min.js',
        'js/checkout.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        // 'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}