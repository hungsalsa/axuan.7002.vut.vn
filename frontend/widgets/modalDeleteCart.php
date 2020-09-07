<?php

namespace frontend\widgets;

use yii\base\Widget;


class modalDeleteCart extends Widget
{
    public $message;

    public function init()
    {
        parent::init();
       
    }

    public function run()
    {
         return $this->render('modalDeleteCart');
    }
}