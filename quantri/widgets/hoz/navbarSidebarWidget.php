<?php

namespace quantri\widgets\hoz;

use yii\base\Widget;
class navbarSidebarWidget extends Widget
{
    public $message;

    public function init()
    {
        parent::init();
       
    }

    public function run()
    {
         return $this->render('navbarSidebarWidget');
    }
}