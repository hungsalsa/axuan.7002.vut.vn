<?php

namespace frontend\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use Yii;
use frontend\models\setting\FMenus;

class customModules extends Widget
{
    public function init()
    {
        parent::init();
       
    }

    public function run()
    {
    	$menu = new FMenus();
        $dataMenu = $menu->getAllMenu();
        // dbg($dataMenu);
        return $this->render('customModules',['dataMenu'=>$dataMenu]);
    }
}