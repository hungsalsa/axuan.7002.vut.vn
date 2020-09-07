<?php

namespace frontend\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use frontend\common\Cart;
use Yii;
use yii\web\Session;
class cartWidget extends Widget
{
    

    public function init()
    {
        parent::init();
       
    }

    public function run()
    {
    	$session = Yii::$app->session;
    	$infoCart = $session['cart'];
    	dbg($infoCart);
    	
    	return $this->render('cartWidget',['infoCart'=>$infoCart]);
    }
}