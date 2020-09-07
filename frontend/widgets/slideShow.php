<?php

namespace frontend\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use Yii;
use frontend\models\setting\FBanner;

class slideShow extends Widget
{
    public $message;

    public function init()
    {
        parent::init();
       
    }

    public function run()
    {
    	// $session = Yii::$app->session;
    	// $infoCart = $session['cart'];
// dbg(Yii::$app->cache->get('cache_website_banner'));
        $model = new FBanner();
        $data['slideshow'] = $model->getAllBanner();
        // dbg($dataCache);
        return $this->render('slideShow',['slideshow'=>$data['slideshow'],'settingModules'=>isset(Yii::$app->params['settingModules']['under_slide_show']) ? Yii::$app->params['settingModules']['under_slide_show']:[]]);
    }
}