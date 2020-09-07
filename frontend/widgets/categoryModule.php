<?php

namespace frontend\widgets;

use yii\base\Widget;
// use frontend\models\product\FProduct;
use Yii;
// use yii\web\Session;

class categoryModule extends Widget
{
    // public $message;
    public $model;

    public function init()
    {
        parent::init();
       // if($this->message===null) $this->message='Hell'
    }

    public function run()
    {
    	// $session = Yii::$app->session;
    	// $infoCart = $session['cart'];
        // $data = $this->model;
        // dbg($data);
        return $this->render('categoryModule',['data'=>$this->model,'productCategory'=>(Yii::$app->params['productCategory']['arrayCateSlugSlug'])?Yii::$app->params['productCategory']['arrayCateSlugSlug'] : []]);
    }
}