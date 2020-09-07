<?php

namespace frontend\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use frontend\common\Cart;
use Yii;
use yii\web\Session;
class ListcartWidget extends Widget
{
    

    public function init()
    {
        parent::init();
       
    }

    public function run()
    {
    	$session = Yii::$app->session;
    	$infoCart = isset($session['cart']) ? $session['cart'] : null;
    	// dbg($infoCart);
    	
    	return $this->render('ListcartWidget',['infoCart'=>$infoCart]);
    }
}