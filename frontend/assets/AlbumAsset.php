<?php

namespace frontend\assets;
use yii\web\AssetBundle;
class AlbumAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'font-awesome/css/all.min.css',
        'js/modules/lightgallery.min.css',
    ];
    public $js = [
        'jquery-3.4.1.min.js',
        // 'jquery-ui/jquery-ui.js',
        'bootstrap-4.4.1/js/bootstrap.min.js',
        // 'https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.7.2/js/lightgallery.min.js',
        'js/modules/lightgallery.min.js',
        // 'js/modules/lg-fullscreen.min.js',
        'js/modules/lg-thumbnail.min.js',
        // 'owlcarousel/owl.carousel.min.js',
        // 'bootstrap-notify.min.js',
        // 'hungsalsa.js',
        // 'main.js',
        'js/album.js',
    ];
    public $depends = [
        // 'yii\web\YiiAsset',
        // 'yii\bootstrap\BootstrapAsset',
    ];
}