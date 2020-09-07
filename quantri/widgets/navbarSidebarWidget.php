<?php

namespace quantri\widgets;

use yii\base\Widget;
use yii\helpers\Html;

class navbarSidebarWidget extends Widget
{
    // public $message;

    public function init()
    {
        parent::init();
       
    }

    public function run()
    {
         return $this->render('navbarSidebarWidget');
    }
}