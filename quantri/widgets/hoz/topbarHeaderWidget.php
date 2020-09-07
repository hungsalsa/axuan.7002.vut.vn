<?php

namespace quantri\widgets\hoz;

use yii\base\Widget;

class topbarHeaderWidget extends Widget
{
    public $message;

    public function init()
    {
        parent::init();
       
    }

    public function run()
    {
         return $this->render('topbarHeaderWidget');
    }
}
