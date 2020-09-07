<?php

namespace quantri\widgets\hoz;

use yii\base\Widget;

class rightSidebarWidget extends Widget
{
    public $message;

    public function init()
    {
        parent::init();
       
    }

    public function run()
    {
         return $this->render('rightSidebarWidget');
    }
}