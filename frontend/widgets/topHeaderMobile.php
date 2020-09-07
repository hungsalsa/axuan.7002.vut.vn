<?php
namespace frontend\widgets;
use yii\base\Widget;
use Yii;
class topHeaderMobile extends Widget
{
    public function init()
    {
        parent::init();
    }
    public function run()
    {
         return $this->render('topHeaderMobile',['settingModules'=>isset(Yii::$app->params['settingModules']['top_header']) ? Yii::$app->params['settingModules']['top_header'] : []]);
    }
}