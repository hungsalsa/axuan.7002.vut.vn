<?php

namespace quantri\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class LoginAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
     'bootstrap/dist/css/bootstrap.min.css',
     // 'plugins/bower_components/bootstrap-extension/css/bootstrap-extension.css',
     // 'css/animate.css',
     'css/style.css',
     'css/colors/megna.css',
     // 'css/login.css',
    ];
    public $js = [
        // 'plugins/bower_components/jquery/dist/jquery.min.js',
        // 'bootstrap/dist/js/tether.min.js',
        // 'bootstrap/dist/js/bootstrap.min.js',
        // 'plugins/bower_components/bootstrap-extension/js/bootstrap-extension.min.js',
        // 'plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js',
        // 'js/jquery.slimscroll.js',
        // 'js/waves.js',
        // 'js/custom.min.js',
        // 'plugins/bower_components/styleswitcher/jQuery.style.switcher.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
