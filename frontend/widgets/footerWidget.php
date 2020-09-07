<?php

namespace frontend\widgets;

use yii\base\Widget;
use Yii;

class footerWidget extends Widget
{
    public $message;

    public function init()
    {
        parent::init();
        
    }

    public function run()
    {
    	// dbg(Yii::$app->params['config']['brands']);
         return $this->render('footerWidget');
    }
}