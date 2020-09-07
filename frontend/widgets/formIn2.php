<?php

namespace frontend\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use Yii;
use frontend\models\setting\FMenus;

class formIn extends Widget
{
    public function init()
    {
        parent::init();
        if ($this->message === null) {
            $this->message = 'Hello World';
        }
       
    }

    public function run()
    {
    	$menu = new FMenus();
        $dataMenu = $menu->getAllMenus();
        dbg($this->message);
        return $this->render('formIn',['dataMenu'=>$dataMenu]);
    }
}