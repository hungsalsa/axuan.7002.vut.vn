<?php

namespace quantri\modules\products\widgets;

use yii\base\Widget;
use yii\helpers\Html;

class thuoctinhWidget extends Widget
{
    public $message;

    public function init()
    {
        parent::init();
       
    }

    public function run()
    {
         return $this->render('thuoctinhWidget');
    }
}