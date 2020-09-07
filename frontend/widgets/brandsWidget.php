<?php

namespace frontend\widgets;

use yii\base\Widget;
use frontend\models\setting\FSettingBrands;
use Yii;
class brandsWidget extends Widget
{
    

    public function init()
    {
        parent::init();
        $site = new FSettingBrands();
        Yii::$app->params['config']['brands'] = $site->getAllBrands();
       
    }

    public function run()
    {
    	
    	return $this->render('brandsWidget',['settingModules'=>isset(Yii::$app->params['settingModules']['above_footer']) ? Yii::$app->params['settingModules']['above_footer']: [],'brands'=>Yii::$app->params['config']['brands']]);
    }
}