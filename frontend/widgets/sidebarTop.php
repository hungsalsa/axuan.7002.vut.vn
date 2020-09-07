<?php

namespace frontend\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use Yii;

class sidebarTop extends Widget
{    public function init()
    {
        parent::init();
    }
    public function run()
    {
    	$home = (Yii::$app->controller->id == 'site' && Yii::$app->controller->action->id=='index')? true: false;
    	// dbg(Yii::$app->controller->id);
    	// dbg(Yii::$app->controller->action->id);
         return $this->render('sidebarTop',['home'=>$home]);
    }
}