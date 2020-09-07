<?php
namespace frontend\common;

use Yii;
use yii\base\Component;
use frontend\models\setting\FSettingModules;
use frontend\models\setting\FSettingDefault;

use frontend\models\setting\FBanner;
use frontend\common\FCacheWebsite;
use yii\helpers\Url;
use frontend\common\Mobile_Detect;
class SiteFrontend extends Component
{
    public function init()
    {
        parent::init();
        $detect = new Mobile_Detect;
        // Any mobile device (phones or tablets).
        $layout   = '';
        if ( $detect->isMobile() ) {
            // die;
            $layout   = '_mobile';
        }
         
        // Any tablet device.
        if( $detect->isTablet() ){
            $layout   = '_tablet';
        }
         
        // Exclude tablets.
        // if( $detect->isMobile() && !$detect->isTablet() ){
         
        // }
         
        // Check for a specific platform with the help of the magic methods:
        // if( $detect->isiOS() ){
         
        // }
         
        // if( $detect->isAndroidOS() ){
         
        // }

        // dbg($layout);
        Yii::$app->params['layout'] = $layout;
        
        // dbg(Yii::$app->params['layout']);
        if(empty(Yii::$app->params['productCategory'])){
            $category = new \frontend\models\product\FProduct();
            Yii::$app->params['productCategory']['idCateArray'] = $category->getAllIdCategory();

            $category = new \frontend\models\product\FProductCategory();
            /*mảng tất cả các tên sử dụng, với slugcate là key*/
            Yii::$app->params['productCategory']['arrayCateSlugName'] = $category->getCategoryParentById(Yii::$app->params['productCategory']['idCateArray'],'slug');
            Yii::$app->params['productCategory']['arrayCateIdName'] = $category->getCategoryParentById(Yii::$app->params['productCategory']['idCateArray']);
            Yii::$app->params['productCategory']['arrayCateSlugSlug'] = $category->getCategorySlugById(Yii::$app->params['productCategory']['idCateArray']);
            Yii::$app->params['productCategory']['arrayCateIdSlug'] = $category->getAllCategoryToSlug();
            // dbg(Yii::$app->params['productCategory']);
        }

        if(empty(Yii::$app->params['newsCategories'])){
            $category = new \frontend\models\news\FNews();
            Yii::$app->params['newsCategories']['idCateArray'] = $category->getAllIdCategories();

            $category = new \frontend\models\news\FCategories();
            /*mảng tất cả các tên sử dụng, với slugcate là key*/
            Yii::$app->params['newsCategories']['arrayCateSlugName'] = $category->getCategoryParentById(Yii::$app->params['newsCategories']['idCateArray'],'slug');
            Yii::$app->params['newsCategories']['arrayCateIdName'] = $category->getCategoryParentById(Yii::$app->params['newsCategories']['idCateArray']);
            Yii::$app->params['newsCategories']['arrayCateSlugSlug'] = $category->getCategorySlugById(array_values(Yii::$app->params['newsCategories']['idCateArray']));
            // dbg(Yii::$app->params['newsCategories']);
        }

        
        $site = new FSettingDefault();
        Yii::$app->params['config']['seohome'] = $site->getSiteinfo();

        // $model = new FCacheWebsite();
        // $dataCache = $model->getallCache();

        // foreach ($dataCache as $key => $value) {
        //     if((time() - $value) < 24*60*60 || !Yii::$app->cache->get($key) ){
        //   // die('dấda'); 
        //     $model = new FBanner();
        //     Yii::$app->cache->set($key, yii\helpers\ArrayHelper::toArray($model->getAllBanner()), 86400);
        //   }
        //     // dbg(Yii::$app->cache->get($key));
        // }

    }
}