<?php
namespace frontend\widgets;
use yii\base\Widget;
use Yii;
class topHeader extends Widget
{
    public function init()
    {
        parent::init();
    }
    public function run()
    {
    	// dbg(Yii::$app->params['settingModules']['top_header']);
         return $this->render('topHeader',['settingModules'=>isset(Yii::$app->params['settingModules']['top_header']) ? Yii::$app->params['settingModules']['top_header'] : []]);
    }
}