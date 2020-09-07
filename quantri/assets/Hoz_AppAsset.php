<?php

namespace quantri\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class Hoz_AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'hoz/bootstrap/dist/css/bootstrap.min.css',
        'plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css',
        // 'plugins/bower_components/toast-master/css/jquery.toast.css',
        // 'plugins/bower_components/morrisjs/morris.css',
        // 'plugins/bower_components/chartist-js/dist/chartist.min.css',
        // 'plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css',
        // 'plugins/bower_components/calendar/dist/fullcalendar.css',
        'hoz/css/animate.css',
        // 'plugins/bower_components/sweetalert/sweetalert.css',
        'hoz/css/style.css',
        ['hoz/css/colors/megna-dark.css', 'id' => 'theme'],
        'hoz/css/hoz_my.css',
    ];
    public $js = [
        'plugins/bower_components/jquery/dist/jquery.min.js',
        'hoz/bootstrap/dist/js/bootstrap.min.js',
        'plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js',
        'hoz/js/jquery.slimscroll.js',
        'hoz/js/waves.js',
        'js/hoz_custom_main.js',
        // 'plugins/bower_components/toast-master/js/jquery.toast.js',
        // 'plugins/bower_components/sweetalert/sweetalert.min.js',
        // 'plugins/bower_components/sweetalert/jquery.sweet-alert.custom.js',
        // 'plugins/bower_components/waypoints/lib/jquery.waypoints.js',
        // 'plugins/bower_components/counterup/jquery.counterup.min.js',
        
        // 'plugins/bower_components/raphael/raphael-min.js',
        // 'plugins/bower_components/morrisjs/morris_main.js',
        // 'plugins/bower_components/chartist-js/dist/chartist.min.js',
        // 'plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js',
        // 'plugins/bower_components/moment/moment.js',
        // 'plugins/bower_components/calendar/dist/fullcalendar.min.js',
        // 'plugins/bower_components/calendar/dist/cal-init.js',
        // 'js/dashboard1.js',
        // 'js/cbpFWTabs.js',
        // 'js/cbpFWTabs_after.js',
        'js/bootstrap-notify.min.js',
        // 'plugins/bower_components/toast-master/js/jquery.toast.js',
        // 'hoz/js/toastr.js',
        // 'hoz/js/custom.min.js',
        'plugins/bower_components/styleswitcher/jQuery.style.switcher_main.js',
    ];
    public $depends = [
        // 'yii\web\YiiAsset',
        // 'yii\bootstrap\BootstrapAsset',
    ];
}
