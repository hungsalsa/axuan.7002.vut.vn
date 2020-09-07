<?php

namespace frontend\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use Yii;
// use yii\web\Session;

class customModulesIn extends Widget
{
    public $content;

    public function init()
    {
        parent::init();
       
    }

    public function run()
    {
    	// $session = Yii::$app->session;
    	// $infoCart = $session['cart'];

        return $this->render('customModulesIn',['content'=>$this->content]);
    }
}