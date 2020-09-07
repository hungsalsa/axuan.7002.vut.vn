<?php

namespace quantri\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class HomeAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
     public $css = [
            'bootstrap/dist/css/bootstrap.min.css',
        'plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css',
        'plugins/bower_components/toast-master/css/jquery.toast.css',
        'plugins/bower_components/morrisjs/morris.css',
        'plugins/bower_components/chartist-js/dist/chartist.min.css',
        'plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css',
        'plugins/bower_components/calendar/dist/fullcalendar.css',
        'css/animate.css',
        'css/style.css',
        'css/my.css',
        // 'css/colors/green.css'.' id="theme"',
        ['css/colors/green.css', 'id' => 'theme'],
    ];
    public $js = [
        'plugins/bower_components/jquery/dist/jquery.min.js',
        'bootstrap/dist/js/bootstrap.min.js',
        'plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js',
        'js/jquery.slimscroll.js',
        'js/waves.js',
        'plugins/bower_components/waypoints/lib/jquery.waypoints.js',
        'plugins/bower_components/counterup/jquery.counterup.min.js',
        'plugins/bower_components/raphael/raphael-min.js',
        'plugins/bower_components/morrisjs/morris.js',
        'plugins/bower_components/chartist-js/dist/chartist.min.js',
        'plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js',
        'plugins/bower_components/moment/moment.js',
        'plugins/bower_components/calendar/dist/fullcalendar.min.js',
        'plugins/bower_components/calendar/dist/cal-init.js',
        'js/custom.min.js',
        'js/dashboard1.js',
        'js/cbpFWTabs.js',
        'js/cbpFWTabs_after.js',
        'plugins/bower_components/toast-master/js/jquery.toast.js',
        'plugins/bower_components/styleswitcher/jQuery.style.switcher.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
