 <?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    // 'language' => 'vi',
    'timeZone' => 'Asia/Bangkok',
    'language' => 'vn',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
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
        // 'timeZone' => 'Asia/Bangkok',
        // set target language
        // 'language' => 'vn',
    ],
    // 'cache' => [
    //     'class' => 'yii\caching\FileCache',
    // ],
];
