<?php

namespace quantri\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use quantri\models\User;

class navbarHeaderErrorWidget extends Widget
{
    // public $message;

    public function init()
    {
        parent::init();
       
    }

    public function run()
    {
        // $user_username = User::findOne(getUser()->id);
        // $rule = $user_username->quyenhan->item_name;
         return $this->render('navbarHeaderErrorWidget');
    }
}
