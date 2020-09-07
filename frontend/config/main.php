<?php
use yii\web\Request;
$baseUrl = str_replace('/frontend/web','', (new Request)->getBaseUrl());
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/../../common/config/app.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log','SiteFrontend'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'products' => [
            'class' => 'frontend\modules\products\products',
        ],
    ],
    'components' => [
        // 'reCaptcha' => [
        //     'class' => 'himiklab\yii2\recaptcha\ReCaptchaConfig',
        //     'siteKeyV2' => '6LdIl-sUAAAAAB2IOSIP_y3eIhTGAFwoPUCfYGP5',
        //     'secretV2' => '6LdIl-sUAAAAAN5BgPf5DXpmk6yJAjUR-lb_ru-J',
        //     // 'siteKeyV3' => '6LfOlOsUAAAAAHGr562VgNUcNfGb4Ol0auVJPMv7',
        //     // 'secretV3' => '6LfOlOsUAAAAAChB428ac2Ih5PRaccF5SJOAESoM',
        // ],
        // 'formatter' => [
        //     'decimalSeparator' => ',',
        //     'thousandSeparator' => '.',
        // ],
        'SiteFrontend'=>[
            'class'=>'frontend\common\SiteFrontend'
        ],

        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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

        'request'=>array(
            'baseUrl'=>$baseUrl
        ),
        
        'urlManager' => [
            'baseUrl'=>$baseUrl,
            'showScriptName' => false,
            'enablePrettyUrl' => true,
            // 'suffix' => '/xuan',
            // 'enableStrictParsing' => false,
            'rules' => [
                // '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                // '<controller:\w+>/<action:\w+>/<slug:\w+>' => '<controller>/<action>',
                // '<controller:\w+>/<action:\w+>/<slug:\w+>' => '<controller>/<action>',
                
                // 'tin-tuc/<slug:[\w\-]+>/trang-<page:\d+>' => 'tin-tuc/index',
                'khach-hang/lien-he' => 'site/lienhe',
                'tag-news/<slugNewTag:[\w\-]+>/trang-<page:\d+>.html'=>'news/tags',
                'tag-news/<slugNewTag:[\w\-]+>.html'=>'news/tags',

                '<slugCate:[\w\-]+>-t<idCate:\d+>/trang-<page:\d+>' => 'news/index',
                '<slugCate:[\w\-]+>-t<idCate:\d+>' => 'news/index',
                '<slugCate:[\w\-]+>/<slug:[\w\-]+>-t<idNew:\d+>.html' => 'news/view',

                

                // 'albums'=>'albums/index',
                // 'albums/<slug:[\w\-]+>.html'=>'albums/view',

                'albums/<slugCate:[\w\-]+>-a<idCate:\d+>/trang-<page:\d+>' => 'albums/index',
                'albums/<slugCate:[\w\-]+>-a<idCate:\d+>'=>'albums/index',
                'albums/<slug:[\w\-]+>.html'=>'albums/view',

                'tim-kiem/tu-khoa/<keySearch:[\w\-]+>.html'=>'product/tag',

                'tag/<slugTag:[\w\-]+>/trang-<page:\d+>.html'=>'product/tags',
                'tag/<slugTag:[\w\-]+>.html'=>'product/tags',
                

                'san-pham-noi-bat/trang-<page:\d+>.html'=>'product/hotproduct',
                'san-pham-noi-bat.html'=>'product/hotproduct',

                

                '<slug:[\w\-]+>/trang-<page:\d+>'=>'product/index',
                '<slug:[\w\-]+>'=>'product/index',


                '<slugCate:[\w\-]+>/<slug:[\w\-]+>.html'=>'product/view',

                // 'shopping-addcart' => 'shopping/addcart',
                'shopping-addcart/<id:\d+>/<number:\d+>' => 'shopping/addcart',
                'shopping/updatecart/<id:\d+>/<number:\d+>' => 'shopping/updatecart',
                'dat-hang/gio-hang' => 'shopping/index',
                'dat-hang/thong-tin' => 'shopping/show-cart',
                

                'tai-lieu/<slugCate:[\w\-]+>-d<idCate:\d+>/trang-<page:\d+>' => 'downloads/index',
                'tai-lieu/<slugCate:[\w\-]+>-d<idCate:\d+>' => 'downloads/index',



                // 'downloads/tai-lieu-<slug:[\w\-]+>.htm' => 'downloads/view',
                // 'tai-tai-lieu/<slug:[\w\-]+>.down' => 'downloads/view',
                // 'search/tukhoa-<typeSearch:\d+>-<keySearch:[w+]+>/trang-<page:\d+>' => 'search/index',
                // 'tim-kiem/tu-khoa-<typeSearch:\d+>' => 'search/index',

                // '<slug:[a-zA-Z0-9]+>-<id:\d+>'=>'search/view',
                // 'tim-kiem/<typeSearch:\d+>' => 'search/view',
                // 'tim-kiem/<typeSearch:\d+>/<keySearch:[\w\-]+>/trang-<page:\d+>' => 'search/view',
                // 'tim-kiem/tu-khoa/<typeSearch:\d+>/<keySearch:[\w\-]+>' => 'search/view',
                // 'tim-kiem/theo-<keySearch:[\w\-]+>-<typeSearch:\d+>/trang-<page:\d+>' => 'search/view',
                // 'tim-kiem/theo-<keySearch:[\w\-]+>-<typeSearch:\d+>' => 'search/view',
                // 'tim-kiem/tu-khoa-<keySearch:[\w\-]+>' => 'search/view',
                // 'tim-kiem/theo-<typeSearch:\d+>/<keySearch:[\w\-]+>' => 'search/view',
                // 'tim-kiem/theo-' => 'search/view',
                // [
                //     'pattern' => 'tim-kiem/<typeSearch:\d+>/<keySearch:[\w\-]+>/<page:\d+>',
                //     'route' => 'search/view',
                //     'defaults' => [
                //         'page' => 1,
                //         'typeSearch' => 1,
                //         'keySearch' => '1'
                //     ],
                // ],
                // 'tim-kiem/<typeSearch:\d+>/<keySearch:[\w\-]+>/<page:\d+>.htm' => 'search/view',
                // '<typeSearch:\d+>/<keySearch:[\w\-]+>' => 'search/view',
                // '<slug:[\w\-]+>/trang-<page:\d+>' => 'categories/index',
                // '<slug:[\w\-]+>' => 'categories/index',
                // 'tim-kiem/<typeSearch:\d+>' => 'search/view',
                // 'tim-kiem' => 'search/view',
               //  [
               //     'pattern' => 'tim-kiem/<typeSearch:\d+>/<keySearch:[w+]+>',
               //     'route' => 'search/view',
               // ],

                // [
                //     'pattern' => 'tin-tuc',
                //     'route' => 'news/view',
                //     'suffix' => '.html',
                // ],
                
                // '<slug:[a-z0-9-]+>/trang-<page:\d+>' => 'category/index',
                // '<slug:[a-z0-9-]+>' => 'category/index',

                // '<slug:[a-z0-9-]+>/trang-<page:\d+>' => 'category/index',
                // '<slug:[a-z0-9-]+>' => 'category/index',
                // 'san-pham-<slug>' => 'product/danhsach',
                // 'san-pham/<slug>/trang-<page:\d+>' => 'product/danhsach',
                
                // 'product'=>'product/index',
                // 'danh'=>'product/listpro',
                // '<slug:[a-zA-Z0-9]+>-<id:\d+>'=>'product/view',
                // '<slug>' => 'product/view',
                // 'product/view/<id:\d+>' => 'product/view', 
                // 'product/<slug>' => 'product/slug',
                'best-online-in-url.online' => 'site/signup-from-url',
                'defaultRoute' => '/site/index',
            ],
        ],
    ],
    'params' => $params,

    // 'container' => [
    //     'definitions' => [
    //         'yii\widgets\LinkPager' => [
    //             'firstPageLabel' => 'First',
    //             'lastPageLabel'  => 'Last'
    //         ]
    //     ]
    // ],
];
