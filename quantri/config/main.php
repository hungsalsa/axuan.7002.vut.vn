<?php
use yii\web\Request;
// use Yii;
$baseUrl = str_replace('/web', '', (new Request)->getBaseUrl());
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-quantri',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'quantri\controllers',
    'bootstrap' => [
        'log',
        'SiteInfo'
    ],

    'modules' => [
        // 'quantri' => [
        //     'class' => 'quantri\modules\quantri\Quantri',
        // ],
        'news' => [
            'class' => 'quantri\modules\news\News',
        ],
        'products' => [
            'class' => 'quantri\modules\products\product',
        ],
        'auth' => [
            'class' => 'quantri\modules\auth\Module',
        ],
        'setting' => [
            'class' => 'quantri\modules\setting\setting',
        ],
        'customer' => [
            'class' => 'quantri\modules\customer\customers',
        ],
    ],
    
    'components' => [
        'formatter' => [
            'class' =>'yii\i18n\Formatter',
            'dateFormat' => 'dd-MM-Y',
            'datetimeFormat' => 'h:i:s a l dd-MM-Y',
            'timeFormat' => 'h:i:s',
           // 'locale' => 'vn', //your language locale
           // 'defaultTimeZone' => 'Asia/Ho_Chi_Minh', // time zone
           'defaultTimeZone' => 'Asia/Bangkok',
            // 'numberFormatterOptions' => [
            //     \NumberFormatter::MIN_FRACTION_DIGITS => 0,
            //     \NumberFormatter::MAX_FRACTION_DIGITS => 2,
            // ],
            'decimalSeparator' => ',',
            'thousandSeparator' => '.',
            'currencyCode' => ' đ',

        ],
        
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'sourcePath' => null,
                    'basePath' => '@webroot',
                    'baseUrl' => '@web',
                    'js' => [
                        'plugins/bower_components/jquery/dist/jquery.min.js',
                    ]
                ],
            ],
        ],
        'SiteInfo'=>[
            'class'=>'quantri\commands\SiteInfo'
        ],

        'request' => [
            'csrfParam' => '_csrf-backend',
            'enableCsrfValidation' => false,
        ],
        // 'admin' => [
        //     'identityClass' => 'common\models\Admin',
        //     'class' => 'common\models\web\Admin',
        //     'enableAutoLogin' => true,
        // ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'request'=>[
            'baseUrl'=>$baseUrl
        ],
        
        'urlManager' => [
            'baseUrl'=>$baseUrl,
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                // 'admin'=>'site/index',
                // '<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',

                'danh-muc-sp'=>'products/productcategory/index',
                'danh-muc-sp/create'=>'products/productcategory/create',
                'danh-muc-sp/view'=>'products/productcategory/view',
                'danh-muc-sp/update'=>'products/productcategory/update',
                'danh-muc-sp/delete'=>'products/productcategory/delete',

                'san-pham'=>'products/default/index',
                'san-pham/create'=>'products/default/create',
                'san-pham/view'=>'products/default/view',
                'san-pham/update'=>'products/default/update',
                'san-pham/delete'=>'products/default/delete',

                'thuoc-tinh-san-pham'=>'products/thuoctinhsp/index',
                'thuoc-tinh-san-pham/create'=>'products/thuoctinhsp/create',
                'thuoc-tinh-san-pham/view'=>'products/thuoctinhsp/view',
                'thuoc-tinh-san-pham/update'=>'products/thuoctinhsp/update',
                'thuoc-tinh-san-pham/delete'=>'products/thuoctinhsp/delete',

                'khach-hang'=>'customer/customer/index',
                'khach-hang/create'=>'customer/customer/create',
                'khach-hang/chi-tiet-<id:\d+>'=>'customer/customer/view',
                'khach-hang/chinh-sua-<id:\d+>'=>'customer/customer/update',
                'khach-hang/delete'=>'customer/customer/delete',

                'hoi-vien'=>'customer/contacts/index',
                // 'hoi-vien/create'=>'customer/contacts/create',
                'hoi-vien/chi-tiet-<id:\d+>'=>'customer/contacts/view',
                'hoi-vien/chinh-sua-<id:\d+>'=>'customer/contacts/update',
                // 'hoi-vien/delete'=>'customer/contacts/delete',

                'tin-tuc'=>'news/categories/index',
                'tin-tuc/create'=>'news/categories/create',
                'tin-tuc/chi-tiet-<id:\d+>'=>'news/categories/view',
                'tin-tuc/chinh-sua-<id:\d+>'=>'news/categories/update',
                'tin-tuc/delete'=>'news/categories/delete',
                
                // 'album/danh-sach'=>'news/categories/albums',


                'downloads/danh-muc'=>'news/categories/downloads',
                'downloads/danh-sach'=>'news/downloads',


                // 'other/value-attribute'=>'quantri/product-attributes-values/index',
                // 'other/value-attribute/create'=>'quantri/product-attributes-values/create',
                // 'other/value-attribute/update'=>'quantri/product-attributes-values/update',
                // 'other/value-attribute/delete'=>'quantri/product-attributes-values/delete',

                // 'defaultRoute' => '/quantri/product',
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest'],
        ],
        
    ],
    'params' => $params,
    // 'defaultRoute' => 'products/default',
];
