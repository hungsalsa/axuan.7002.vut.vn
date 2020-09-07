<?php

namespace quantri\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class EditAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'bootstrap/dist/css/bootstrap.min.css',
        'plugins/bower_components/bootstrap-extension/css/bootstrap-extension.css',
        'plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css',
        'plugins/bower_components/morrisjs/morris.css',
        'css/animate.css',
        'css/style.min.css',
        'css/colors/megna.css',
        'css/jquery-ui.min.css',
        'css/my.css'
    ];
    public $js = [
        'plugins/bower_components/jquery/dist/jquery.min.js',
        'bootstrap/dist/js/tether.min.js',
        'bootstrap/dist/js/bootstrap.min.js',
        // 'plugins/bower_components/bootstrap-extension/js/bootstrap-extension.min.js',
        'plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js',
        'js/jquery.slimscroll.js',
        // 'js/waves.js',
        // 'plugins/bower_components/raphael/raphael-min.js',
        // 'plugins/bower_components/morrisjs/morris.js',
        // 'plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js',
        // 'plugins/bower_components/peity/jquery.peity.min.js',
        // 'plugins/bower_components/peity/jquery.peity.init.js',
        'js/custom.min.js',
        // 'js/dashboard1.js',
        // 'plugins/bower_components/styleswitcher/jQuery.style.switcher.js',
        // 'js/jquery-ui.min.js',
        // 'tinymce/tinymce.min.js',
        // 'js/main.js',
    ];
    public $depends = [
        // 'yii\web\YiiAsset',
        // 'yii\bootstrap\BootstrapAsset',
    ];
}
